<?php
namespace Models;

if(!class_exists('TransectionsDB')):
class TransectionsDB {
    private $db;
    protected $table = 'lb_transections';
    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix . $this->table;
    }

    public function getTable() {
        return $this->table;
    }

    public function createTable() {
        $charset_collate = $this->db->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            ID INT(11) NOT NULL AUTO_INCREMENT,
            type VARCHAR(10) NOT NULL,
            description VARCHAR(255) NOT NULL,
            amount FLOAT NOT NULL,
            deal_id INT(11) default 0,
            lead_id INT(11) default 0,
            business_id INT(11) NOT NULL,
            created_by INT(11) NOT NULL,
            managed_by INT(11) NOT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function dropTable() {
        $this->db->query("DROP TABLE IF EXISTS {$this->table}");
        delete_option('leadbook_db_version');
    }

    public function exists() {
        return $this->db->get_var("SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '{$this->table}'");
    }

    public function truncate() {
        return $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function count() {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function getAll(array $data=['order'=>'DESC', 'limit'=>20]) {
        extract($data);
        return $this->db->get_results("SELECT * FROM {$this->table} ORDER BY id {$order} LIMIT {$limit}");
    }

    public function get($id) {
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE ID = {$id}");
    }

    public function checkDeal($id) {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table} WHERE deal_id = {$id}");
    }

    public function getCreditedAmount($business_id = null) {
        if(isset($business_id)) {
            return $this->db->get_var("SELECT SUM(amount) FROM {$this->table} WHERE business_id = {$business_id} AND type = 'credit'");
        }
        return $this->db->get_var("SELECT SUM(amount) FROM {$this->table} WHERE type = 'credit'");
    }

    public function getDebitedAmount($business_id = null) {
        if(isset($business_id)) {
            return $this->db->get_var("SELECT SUM(amount) FROM {$this->table} WHERE business_id = {$business_id} AND type = 'debit'");
        }
        return $this->db->get_var("SELECT SUM(amount) FROM {$this->table} WHERE type = 'debit'");
    }

    public function getByLead($id) {
        return $this->db->get_results("SELECT * FROM {$this->table} WHERE lead_id = {$id}");
    }

    public function getByBusiness($id) {
        return $this->db->get_results("SELECT * FROM {$this->table} WHERE business_id = {$id}");
    }

    public function insert($data) {
        $results = array_merge($data, array('created_at' => gmdate('Y-m-d H:i:s'), 'updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->insert($this->table, $results);
        return $this->db->insert_id;
    }

    public function update($id, $data) {
        $results = array_merge($data, array('updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->update($this->table, $results, array('ID' => $id));
        return $id;
    }

    public function updateByDeal($deal_id, $data) {
        $results = array_merge($data, array('updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->update($this->table, $results, array('deal_id' => $deal_id));
        return $deal_id;
    }

    public function delete($id) {
        $this->db->delete($this->table, array('ID' => $id));
        return $id;
    }

    public function deleteByDealId($deal_id) {
        $this->db->delete($this->table, array('deal_id' => $deal_id));
        return $deal_id;
    }

    public function deleteByLeadId($lead_id) {
        $this->db->delete($this->table, array('lead_id' => $lead_id));
        return $lead_id;
    }

    public function deleteByBusinessId($business_id) {
        $this->db->delete($this->table, array('business_id' => $business_id));
        return $business_id;
    }
}
endif;
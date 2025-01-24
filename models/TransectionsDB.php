<?php
namespace Models;

require_once LEADBOOK_MODELS . 'BaseModel.php';
use Models\BaseModel;

if(!class_exists('TransectionsDB')):
class TransectionsDB extends BaseModel {
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
            type VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            amount FLOAT NOT NULL,
            lead_id INT(11) NOT NULL,
            business_id INT(11) NOT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (id)
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
        $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function count() {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function getAll() {
        return $this->db->get_results("SELECT * FROM {$this->table}");
    }

    public function get($id) {
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE ID = {$id}");
    }

    public function insert($data) {
        $results = array_merge($data, array('created_at' => gmdate('Y-m-d H:i:s'), 'updated_at' => gmdate('Y-m-d H:i:s')));
        return $this->db->insert($this->table, $results);
    }

    public function update($id, $data) {
        $results = array_merge($data, array('updated_at' => gmdate('Y-m-d H:i:s')));
        return $this->db->update($this->table, $results, array('ID' => $id));
    }

    public function delete($id) {
        return $this->db->delete($this->table, array('ID' => $id));
    }

    public function deleteByLeadId($lead_id) {
        return $this->db->delete($this->table, array('lead_id' => $lead_id));
    }

    public function deleteByBusinessId($business_id) {
        return $this->db->delete($this->table, array('business_id' => $business_id));
    }
}
endif;
<?php
namespace Models;

require_once LEADBOOK_MODELS . 'BaseModel.php';
use Models\BaseModel;

if(!class_exists('LeadsDB')):
class LeadsDB extends BaseModel {
    private $db;
    protected $table = 'lb_leads';
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
            purpose VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            mobile VARCHAR(255) NOT NULL,
            email VARCHAR(255) default NULL,
            alt_mobile VARCHAR(255) default NULL,
            whatsapp VARCHAR(255) default NULL,
            address VARCHAR(255) default NULL,
            city VARCHAR(255) default NULL,
            state VARCHAR(255) default NULL,
            country VARCHAR(255) default NULL,
            pincode VARCHAR(255) default NULL,
            source VARCHAR(255) NOT NULL,
            status VARCHAR(255) NOT NULL,
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
    public function exists(){
        return $this->db->get_var("SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '{$this->table}'");
    }

    public function truncate() {
        return $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function dropTable() {
        $this->db->query("DROP TABLE IF EXISTS {$this->table}");
        delete_option('leadbook_db_version');
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

    public function delete($id) {
        $this->db->delete($this->table, array('ID' => $id));
        return $id;
    }

    public function getAll(array $data=['order'=>'DESC', 'limit'=>20]) {
        extract($data);
        return $this->db->get_results("SELECT * FROM {$this->table} ORDER BY id {$order} LIMIT {$limit}");
    }

    public function get($id) {
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE ID = {$id}");
    }

    public function count() {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function getByBusiness($business_id) {
        return $this->db->get_results("SELECT * FROM {$this->table} WHERE business_id = {$business_id}");
    }
    public function business(){
        return $this->belongsTo(BusinessesDB::class, 'business_id');
    }

    // public function getFllowups() {
    //     $followups = new FollowupsDB();
    //     $followups_table = $followups->getTable();
    //     return $this->db->get_results("SELECT * FROM {$followups_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$followups_table}.lead_id");
    // }

    public function followups(){
        return $this->hasMany(FollowupsDB::class, 'lead_id');
    }

    // public function getFollowup($id) {
    //     $followups = new FollowupsDB();
    //     $followups_table = $followups->getTable();
    //     return $this->db->get_row("SELECT * FROM {$followups_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$followups_table}.lead_id WHERE {$followups_table}.ID = {$id}");
    // } 

    // public function getDeals(){
    //     $deals = new DealsDB();
    //     $deals_table = $deals->getTable();
    //     return $this->db->get_results("SELECT * FROM {$deals_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$deals_table}.lead_id");
    // }

    // public function getDeal($id){
    //     $deals = new DealsDB();
    //     $deals_table = $deals->getTable();
    //     return $this->db->get_row("SELECT * FROM {$deals_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$deals_table}.lead_id WHERE {$deals_table}.ID = {$id}");
    // }

    public function deals(){
        return $this->hasMany(DealsDB::class, 'lead_id');
    }

    // public function getTransections(){
    //     $transections = new TransectionsDB();
    //     $transections_table = $transections->getTable();
    //     return $this->db->get_results("SELECT * FROM {$transections_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$transections_table}.lead_id");
    // }

    // public function getTransection($id){
    //     $transections = new TransectionsDB();
    //     $transections_table = $transections->getTable();
    //     return $this->db->get_row("SELECT * FROM {$transections_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$transections_table}.lead_id WHERE {$transections_table}.ID = {$id}");
    // }

    public function transections(){
        return $this->hasMany(TransectionsDB::class, 'lead_id');
    }

    public function deleteByBusinessId($business_id) {
        return $this->db->delete($this->table, array('business_id' => $business_id));
    }
}
endif;
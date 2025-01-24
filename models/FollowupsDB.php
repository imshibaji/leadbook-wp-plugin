<?php
namespace Models;

require_once LEADBOOK_MODELS . 'BaseModel.php';
use Models\BaseModel;

if(!class_exists('FollowupsDB')):
class FollowupsDB extends BaseModel {
    private $db;
    protected $table = 'lb_followups'; 
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
            title VARCHAR(255) NOT NULL,
            description TEXT default NULL,
            status VARCHAR(255) NOT NULL,
            type VARCHAR(255) NOT NULL,
            next_reminder DATETIME NOT NULL,
            
            user_id INT(11) NOT NULL,
            lead_id INT(11) NOT NULL,
            business_id INT(11) NOT NULL,
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

    public function truncate() {
        $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function insert($data) {
        $results = array_merge($data, array('created_at' => gmdate('Y-m-d H:i:s'), 'updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->insert($this->table, $results);
    }

    public function update($id, $data) {
        $results = array_merge($data, array('updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->update($this->table, $results, array('ID' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('ID' => $id));
    }

    public function getAll() {
        return $this->db->get_results("SELECT * FROM {$this->table}");
    }

    public function get($id) {
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE ID = {$id}");
    }

    public function count() {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    // public function user(){
    //     return $this->belongsTo(UsersDB::class, 'user_id');
    // }

    public function lead(){
        return $this->belongsTo(LeadsDB::class, 'lead_id');
    }

    public function business(){
        return $this->belongsTo(BusinessesDB::class, 'business_id');
    }

    // public function getByLead($id) {
    //     return $this->db->get_row("SELECT * FROM {$this->table} WHERE lead_id = {$id}");
    // }

    // public function getByBusiness($id) {
    //     return $this->db->get_results("SELECT * FROM {$this->table} WHERE business_id = {$id}");
    // }

    public function deleteByLead($id) {
        $this->db->delete($this->table, array('lead_id' => $id));
    }

    public function deleteByBusiness($id) {
        $this->db->delete($this->table, array('business_id' => $id));
    }
}
endif;
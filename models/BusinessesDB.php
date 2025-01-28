<?php
namespace Models;

require_once LEADBOOK_MODELS . 'BaseModel.php';
use Models\BaseModel;

if(!class_exists('BusinessesDB')):
class BusinessesDB extends BaseModel {
    private $db;
    protected $table = 'lb_business';
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
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            mobile VARCHAR(255) NOT NULL,
            alt_mobile VARCHAR(255) default NULL,
            whatsapp VARCHAR(255) default NULL,
            address VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            state VARCHAR(255) NOT NULL,
            country VARCHAR(255) NOT NULL,
            pincode VARCHAR(255) NOT NULL,
            website VARCHAR(255) default NULL,
            description TEXT default NULL,
            logo VARCHAR(255),

            bank_name VARCHAR(255) default NULL,
            account_number VARCHAR(255) default NULL,
            ifsc_code VARCHAR(255) default NULL,
            gst_number VARCHAR(255) default NULL,
            pan_number VARCHAR(255) default NULL,
            aadhar_number VARCHAR(255) default NULL,
            pan_image VARCHAR(255) default NULL,
            aadhar_image VARCHAR(255) default NULL,
            bank_image VARCHAR(255) default NULL,


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

    public function truncate() {
        $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function count() {
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function getAll(array $data=['order'=>'DESC', 'limit'=>20]) {
        extract($data);
        return $this->db->get_results("SELECT * FROM {$this->table} ORDER BY id {$order} LIMIT {$limit}");
    }

    public function get($id) {
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE id = {$id}");
    }

    public function insert($data) {
        $data['created_at'] = gmdate('Y-m-d H:i:s');
        $data['updated_at'] = gmdate('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $data['updated_at'] = gmdate('Y-m-d H:i:s');
        return $this->db->update($this->table, $data, array('ID' => $id));
    }

    public function delete($id) {
        return $this->db->delete($this->table, array('ID' => $id));
    }

    // public function getLeads() {
    //     $leads = new Leadbook_LeadsDB();
    //     $leads_table = $leads->getTable();
    //     return $this->db->get_results("SELECT * FROM {$leads_table} INNER JOIN {$this->table} ON {$this->table}.ID = {$leads_table}.business_id");
    // }
    public function leads(){
        return $this->hasMany(LeadsDB::class, 'business_id');
    }
}
endif;
<?php
namespace Models;

if(!class_exists('DealsDB')):
class DealsDB {
    private $db;
    protected $table = 'lb_deals';
    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix . $this->table;
    }

    public function getTable(){
        return $this->table;
    }

    public function createTable(){
        $charset_collate = $this->db->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            ID INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description JSON NOT NULL,
            currency_code VARCHAR(5) NOT NULL,
            amount FLOAT default 0,
            discount FLOAT default 0,
            discount_type VARCHAR(10) NOT NULL,
            advance FLOAT default 0,
            tax_name VARCHAR(255) NULL,
            tax_amount FLOAT default 0,
            tax_type VARCHAR(10) NOT NULL,
            balance FLOAT default 0,
            due_date DATETIME default now(),
            total FLOAT default 0,
            status VARCHAR(255) NOT NULL,
            lead_id INT(11) NOT NULL,
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

    public function dropTable(){
        $this->db->query("DROP TABLE IF EXISTS {$this->table}");
        delete_option('leadbook_db_version');
    }

    public function exists(){
        return $this->db->get_var("SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '{$this->table}'");
    }

    public function truncate(){
        return $this->db->query("TRUNCATE TABLE {$this->table}");
    }

    public function insert($data){
        $results = array_merge($data, array('created_at' => gmdate('Y-m-d H:i:s'), 'updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->insert($this->table, $results);
        return $this->db->insert_id;
    }

    public function update($id, $data){
        $results = array_merge($data, array('updated_at' => gmdate('Y-m-d H:i:s')));
        $this->db->update($this->table, $results, array('ID' => $id));
        return $id;
    }

    public function delete($id){
        $this->db->delete($this->table, array('ID' => $id));
        return $id;
    }

    public function getAll(array $data=['order'=>'DESC', 'limit'=>20]) {
        extract($data);
        return $this->db->get_results("SELECT * FROM {$this->table} ORDER BY id {$order} LIMIT {$limit}");
    }

    public function get($id){
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE ID = {$id}");
    }

    public function count(){
        return $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function getByLead($id){
        return $this->db->get_row("SELECT * FROM {$this->table} WHERE lead_id = {$id}");
    }

    public function getByBusiness($id){
        return $this->db->get_results("SELECT * FROM {$this->table} WHERE business_id = {$id}");
    }
}
endif;
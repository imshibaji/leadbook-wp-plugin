<?php
namespace Models;
class BaseModel {
    protected $table;
    protected $primaryKey = 'ID';
    protected $fillable = [];
    
    public function __construct($table, $fillable = [], $primaryKey = 'ID') {
        global $wpdb;
        $this->table = $wpdb->prefix . $table;
        $this->fillable = $fillable;
        $this->primaryKey = $primaryKey;
    }

    public function all() {
        global $wpdb;
        $query = "SELECT * FROM {$this->table}";
        return $wpdb->get_results($query, ARRAY_A);
    }

    public function find($id) {
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = %d", $id);
        return $wpdb->get_row($query, ARRAY_A);
    }

    public function create($data) {
        global $wpdb;
        $filteredData = array_intersect_key($data, array_flip($this->fillable));
        $wpdb->insert($this->table, $filteredData);
        return $wpdb->insert_id;
    }

    public function update($id, $data) {
        global $wpdb;
        $filteredData = array_intersect_key($data, array_flip($this->fillable));
        return $wpdb->update($this->table, $filteredData, [$this->primaryKey => $id]);
    }

    public function delete($id) {
        global $wpdb;
        return $wpdb->delete($this->table, [$this->primaryKey => $id]);
    }

    public function hasOne($relatedClass, $foreignKey, $localKey = null) {
        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedClass;
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$related->table} WHERE {$foreignKey} = %d", $this->{$localKey});
        return $wpdb->get_row($query, ARRAY_A);
    }

    public function hasMany($relatedClass, $foreignKey, $localKey = null) {
        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedClass;
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$related->table} WHERE {$foreignKey} = %d", $this->{$localKey});
        return $wpdb->get_results($query, ARRAY_A);
    }

    public function belongsTo($relatedClass, $foreignKey, $ownerKey = null) {
        $ownerKey = $ownerKey ?? $this->primaryKey;
        $related = new $relatedClass;
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$related->table} WHERE {$ownerKey} = %d", $this->{$foreignKey});
        return $wpdb->get_row($query, ARRAY_A);
    }

    public function belongsToMany($relatedClass, $pivotTable, $foreignPivotKey, $relatedPivotKey, $localKey = null, $relatedKey = null) {
        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedClass;
        global $wpdb;
        $query = $wpdb->prepare(
            "SELECT r.* FROM {$related->table} r 
            INNER JOIN {$wpdb->prefix}{$pivotTable} p 
            ON r.{$relatedKey} = p.{$relatedPivotKey} 
            WHERE p.{$foreignPivotKey} = %d",
            $this->{$localKey}
        );
        return $wpdb->get_results($query, ARRAY_A);
    }
}
<?php
namespace Models;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $idName = '';
    protected static $columnsDB = [];

    // Alertas y Mensajes
    protected static $alerts = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }
    // Validación
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // Registros - CRUD
    public function save($id) {
        $result = '';
        if(!is_null($id)) {
            // actualizar
            $result = $this->update($id);
        } else {
            // Creando un nuevo registro
            $result = $this->create();
        }
        return $result;
    }

    public static function all($order = 'DESC') {
        $query = "SELECT * FROM " . static::$table ." ORDER BY ".static::$idName." $order";
        $result = self::consultSQL($query);
        return $result;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE " . static::$idName ." = $id";
        $result = self::consultSQL($query);
        return array_shift( $result ) ;
    }

    // Obtener Registro
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT $limit";
        $result = self::consultSQL($query);
        return $result;
    }

    public static function page($per_page, $offset) {
        $query = "SELECT * FROM " . static::$table . " LIMIT $per_page OFFSET $offset";
        $result = self::consultSQL($query);
        return $result;
    }

    // Busqueda Where con Columna 
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
        $result = self::consultSQL($query);
        return array_shift( $result ) ;
    }

    public static function whereArray($array = []) {
        $query = "SELECT * FROM " . static::$table  ." WHERE ";
        foreach($array as $key => $value){
            $query .= "$key = '$value'";
            if($key !== array_key_last($array)){
                $query .= " AND ";
            }
        }
        $result = self::consultSQL($query);
        return $result;
    }
    //retornar por orden
    public static function orderby($column, $order){
        $query = "SELECT * FROM " . static::$table  ." ORDER BY $column $order";
        $result = self::consultSQL($query);
        return $result;
    } 

    public static function orderbylimit($column, $order, $limit){
        $query = "SELECT * FROM " . static::$table  ." ORDER BY $column $order LIMIT $limit";
        $result = self::consultSQL($query);
        return $result;
    } 

    //consulta la cantidad de registros
    public static function count($column = '', $value = ''){
        $query = "SELECT COUNT(*) FROM " . static::$table;
        if($column){
            $query .= " WHERE $column = $value";
        }
        $result = self::$db->query($query);
        $total = $result->fetch_array();
        return array_shift($total);
    }

    public static function countArray($array = []){
        $query = "SELECT COUNT(*) FROM " . static::$table . " WHERE ";
        foreach($array as $key => $value){
            $query .= "$key = '$value'";
            if($key !== array_key_last($array)){
                $query .= " AND ";
            }   
        }
        $result = self::$db->query($query);
        $total = $result->fetch_array();
        return array_shift($total);
    }

    //buscan todos los registros que pertenecen a un id
    public static function belongsTo($column, $value) {
        $query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
        $result = self::consultSQL($query);
        return $result;
    }

    // SQL para Consultas Avanzadas.
    public static function SQL($query) {
        $result = self::consultSQL($query);
        return $result;
    }

    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();
        
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        // Resultado de la consulta
        $result = self::$db->query($query);

        return [
           'result' =>  $result,
           static::$idName => self::$db->insert_id
        ];
    }

    public function update($id) {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();

        // Iterar para ir agregando cada campo de la BD
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE ". static::$idName ." = '" . self::$db->escape_string($id) . "' ";
        $query .= " LIMIT 1 "; 
        
        $result = self::$db->query($query);
        return $result;
    }

    // Eliminar un registro - Toma el ID de Active Record
    public function delete($id) {
        $query = "DELETE FROM "  . static::$table . " WHERE ". static::$idName ." = " . self::$db->escape_string($id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function consultSQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($register = $result->fetch_assoc()) {
            $array[] = static::createObjet($register);
        }

        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }

    protected static function createObjet($register) {
        $objet = new static;

        foreach($register as $key => $value ) {
            if(property_exists( $objet, $key  )) {
                $objet->$key = $value;
            }
        }

        return $objet;
    }

    // Identificar y unir los atributos de la BD
    public function attributes() {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === static::$idName) continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function synchronize($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}
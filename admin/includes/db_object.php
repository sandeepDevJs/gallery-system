<?php

    class Db_object{

        public static function find_all(){
            global $db;
            $result = static::find_this_query("SELECT * FROM " .static::$table);
            return $result;
        }

        public static function find_by_id($id){
            global $db;
            $result = static::find_this_query("SELECT * FROM ".static::$table." WHERE id = $id");
            return !empty($result)?array_shift($result):false;
        }

        public function create(){
            global $db;
            $properties = $this->clean_properties();

            $sql = "INSERT INTO ".static::$table."(".implode(",", array_keys($properties)).") 
                VALUES ('". implode("','", array_values($properties)) ."')";

            if($db->query($sql)){
                $this->id = $db->the_insert_id();
                return true;
            }else{
                return false;
            }
        }

        public function update(){
            global $db;
            $properties = $this->clean_properties();
            $property_pairs = array();
            foreach ($properties as $key => $value) {
                $property_pairs[] = "{$key} = '{$value}'";
            }

            $sql = "UPDATE " .static::$table." SET ".implode(", ", $property_pairs)." WHERE id = $this->id";
            $db->query($sql);
            return (mysqli_affected_rows($db->connection) == 1)?true:false;

        }

        public function delete()
        {
            global $db;
            $sql = "DELETE FROM ".static::$table." WHERE id = {$this->id}";
            $db->query($sql);
            return (mysqli_affected_rows($db->connection) == 1)?true:false;
        }

        public function save(){
            return isset($this->id)? $this->update() : $this->create();
        }

        public static function find_this_query($sql)
        {
            global $db;
            $obj_array = array();
            $result = $db->query($sql);
            while($row = mysqli_fetch_array($result)){
                $obj_array[] = static::instantation($row);
            }
            return $obj_array;
            
        }
        
        public static function instantation($user_found){
            
            $calling_class = get_called_class();
            $obj = new $calling_class;
            foreach ($user_found as $attribute => $value) {
                if($obj->has_the_attribute($attribute)){
                    $obj->$attribute = $value;
                }
            }

            return $obj;
        }

        private function has_the_attribute($attribute){
            $obj_properties = get_object_vars($this);
            return array_key_exists($attribute, $obj_properties);
        }

        protected function properties(){
            $properties = array();
            foreach (static::$table_fields as $field) {
                if(property_exists($this, $field)){
                    $properties[$field] = $this->$field; 
                }
            }
            return $properties;
        }
        
        protected function clean_properties(){
            global $db;
            $clean_properties = array();
            foreach ($this->properties() as $key => $value) {
                $clean_properties[$key] = $db->escape_string($value);
            }
            return $clean_properties;
        }

        public function count_all()
        {
            global $db;
            $sql =  "SELECT COUNT(*) FROM ".static::$table;
            $result = $db->query($sql);
            $row = mysqli_fetch_array($result);
            
            return array_shift($row);
        }

    }

?>
<?php

class User extends Db_object
{

    protected static $table        = "users";
    protected static $table_fields = array("username", "password", "first_name", "last_name", "user_image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $filename;
    public $tmp_path;
    public $erros = array();
    public $upload_directory  = "images";
    public $image_placeholder = '_large_image_2.jpg';

    public static function verify_user($username, $password)
    {
        global $db;
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        $sql    = "SELECT * FROM " . self::$table . " WHERE username = '{$username}' AND password = '{$password}'";
        $result = self::find_this_query($sql);
        return !empty($result) ? array_shift($result) : false;
    }

    public function get_image()
    {
        return (empty($this->user_image)) ? $this->upload_directory . DS . $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There Was No File Uploaded!!";
            return false;
        } elseif ($file['error'] != 0) {
            $this->error[] = $upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->user_image = $this->filename;
            $this->tmp_path = $file['tmp_name'];
            
        }
    }

    public function save_user_by_image()
    {

        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->filename) || empty($this->tmp_path)) {
            $this->errors[] = "There Was No File Uploaded!!";
            return false;
        }
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
        if (file_exists($target_path)) {
            $this->errors[] = "File name {$this->filename} already exists!!";
            return false;
        }
        if (move_uploaded_file($this->tmp_path, $target_path)) {
            if ($this->update()) {
                unset($this->tmp_path);
                return true;
            }
        }
    }

    public function ajax_save($image_name, $user_id)
    {
        global $db;
        $this->user_image = $db->escape_string($image_name);
        $this->id = $db->escape_string($user_id);
        $this->save();
        echo $this->get_image();
    }
}

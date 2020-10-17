<?php

class Photo extends Db_object
{

    protected static $table        = "photos";
    protected static $table_fields = array("id", "title", "description", "filename", "type", "size");
    public $id;
    public $title;
    public $date_added;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_directory    = "images";
    public $errors              = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_NO_FILE    => "NO FILE WAS ATTACHED!!!",
        UPLOAD_ERR_INI_SIZE   => "THE UPLOADED FILE EXCEEDS upload_max_file_size INI VARIABLE",
        UPLOAD_ERR_FORM_SIZE  => "THE UPLOADED FILE EXCEEDS max_file_size INI VARIABLE",
        UPLOAD_ERR_PARTIAL    => "THE UPLOADED FILE WAS ONLY PARTIALLY UPLOADED",
        UPLOAD_ERR_NO_TMP_DIR => "MISSING A TEMPORARY FOLDER",
        UPLOAD_ERR_EXTENSION  => "A PHP EXTENSION STOPPED THE FILE UPLOAD",
    );

    public function multi_upload(){
        if(!empty($this->errors)){
            return false;
        }
        if(empty($this->filename) || empty($this->tmp_path)){
            $this->errors[] = "There Was No File Uploaded!!";
            return false;
        }
        $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;
        if(file_exists($target_path)){
            $this->errors[] = "File name {$this->filename} already exists!!";
            return false;
        }
        if(move_uploaded_file($this->tmp_path, $target_path)){
            if($this->create()){
                unset($this->tmp_path);
                return true;
            }
        }
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
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }

    public function save()
    {
        if($this->id){
            $this->update();
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "There Was No File Uploaded!!";
                return false;
            }
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;
            if(file_exists($target_path)){
                $this->errors[] = "File name {$this->filename} already exists!!";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }
        }
    }

    public function delete_photo(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            return unlink($target_path)?true:false;     
        }else{
            return false;
        }
    }

}

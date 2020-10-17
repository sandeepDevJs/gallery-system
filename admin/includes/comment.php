<?php

class Comment extends Db_object
{

    protected static $table        = "comments";
    protected static $table_fields = array("id", "photo_id", "author", "body", "date_added");
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $date_added;

    public static function create_comment($photo_id, $author="john", $body=""){
        if(!empty($photo_id) || !empty($author) || !empty($body)){
            $comment = new Comment();
            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;
            $comment->date_added = date('d:m:y H:i:s');
            return $comment;

        }else{
            return false;
        }
    }

    public static function find_comments($photo_id){
        global $db;
        $photo_id = $db->escape_string($photo_id);
        $sql = "SELECT * FROM ".self::$table." WHERE photo_id = $photo_id ORDER BY photo_id ASC";
        return self::find_this_query($sql);
    }
    
}

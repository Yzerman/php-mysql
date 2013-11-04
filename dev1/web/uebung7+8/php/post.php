<?php


// Model Class representing a Post
class Post {

        public $id;
        public $title;
        public $content;
        public $created;


        function __construct($id, $created, $title, $content) {
                $this -> id = $id;
                $this -> title = $title;
                $this -> content = $content;
                $this -> created = $created;
        }

}


?>


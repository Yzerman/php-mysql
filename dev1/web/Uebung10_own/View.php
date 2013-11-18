<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class view {

    function displayEntry($entry) {
        echo "<b>".$entry["title"] . "</b><br />";
        echo $entry["content"] . "<br />";
    }

    function displayText($text) {
        echo $text;
    }
    
    function displayArrayTable($text) {
        echo $text;
    }

}
?>
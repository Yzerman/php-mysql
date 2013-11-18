<?php  
session_start();

require'kanton_include.php';

/**
 * Klasse für den Datenzugriff
 */
class Model{    

    public static function getEntries(){
//      return self::$entries;
        return $_SESSION["Kantone"];
    }
    /*
    public static function editEntries($id,$title,$content){
        $_SESSION["Kantone"][$id-1] = array("title"=>$title, "content"=>$content); 
        return 0;
    }
    */
    /**
     * Gibt einen bestimmten Eintrag zurück.
     *
     * @param int $id Id des gesuchten Eintrags
     * @return Array Array, dass einen Eintrag repräsentiert, bzw.
     *                  wenn dieser nicht vorhanden ist, null.
     */
    public static function getEntry($id){
        if(array_key_exists($id, $_SESSION["entries"])){
            return $_SESSION["entries"][$id];
        }else{
            return null;
        }
    }
}
?>
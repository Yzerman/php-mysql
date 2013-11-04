<?php

require_once("Lebewesen.php");

class Mensch extends Lebewesen {

    private $name;
    private $geschlecht;

    function __construct($name, $geschlecht) {
        $this->name = $name;
        $this->geschlecht = $geschlecht;
        $this->setAlter($this->getAlter()+1);
    }

    function __destruct() {
        echo "Person gestorben <br>";
    }

    public function altern() {
        $this->setAlter($this->getAlter()+1);
    }

    public function getName() {
        return $this->name;
    }

    public function umbenennen($name) {
        $this->name = $name;
    }

    public function geburtstagFeiern() {
        $this->setAlter($this->getAlter()+1);
        echo "happy-b-day";
    }

    private static $vorfahre = "Hans";

    public static function neueEvolutionstheorie($vorfahre) {
        Mensch::$vorfahre = $vorfahre;
    }

    public static function getVorfahre() {
        return Mensch::$vorfahre;
    }


}


?>


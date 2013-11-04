<?php

	ini_set('display_errors', '1');
    error_reporting(E_ALL);
	require_once("Schweizer.php");
	require_once("Mensch.php");
	require_once("Lebewesen.php");

	class class_app {

		private $mensch;
		private $pers;

		public function __construct(){


		}

		public function run(){

				$mensch = new Mensch("Patrice Keusch", "männlich");
				echo "<p>".$mensch->getName() . "</br>";

				$mensch->umbenennen("Pat Keusch");


				echo "<p>"."Alter: " . $mensch->getAlter() . "<br/>";

				if (is_a($mensch, "Mensch")) {
				    echo "Ist ein Mensch<br/>";
				} else {
				    echo "Ist kein Mensch<br/>";
				}

				echo "Vorfahre: " . Mensch::getVorfahre() . "<br/>";
				Mensch::neueEvolutionstheorie("Fisch");
				echo "Vorfahre: " . Mensch::getVorfahre() . "<br/>";

				$pers = new Schweizer("Hans Müller", "männdlich");
				$pers->umbenennen("lolipop");


		}


	}
	$app = new class_app();
	$app->run();

?>


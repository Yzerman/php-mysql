<?php

	abstract class Lebewesen {

		public abstract function altern();

		private $alter;

		protected function setAlter($alter) {
		    $this->alter = $alter;
		}

		public function getAlter() {
		    return $this->alter;
		}

	}

?>


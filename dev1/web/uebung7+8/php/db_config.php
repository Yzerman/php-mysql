<?php

# Error level
ini_set('display_errors', 1);
error_reporting(E_ALL);

# DB settings
define("DB_CONNECTION", "mysql:host=localhost;dbname=loc_orm");
define("DB_USER", "loc_orm");
define("DB_PASSWORD", "12341234");
//define("DB_USER", "root");
//define("DB_PASSWORD", "vagrant");

# debug mode
define("DEBUGGING", false);

$db = null;

function openDBConnection() {
	try {

		$pdo =  new PDO(DB_CONNECTION, DB_USER, DB_PASSWORD);
		if (DEBUGGING == true && $pdo != null) {
			echo 'Connection to DB established ..';
		}
		return $pdo;
	} catch(PDOException $e) {
		die ('Could not open connection to '.DB_CONNECTION);
	}
}

function getDb() {
	global $db;
	if ($db == null) {
		$db = openDBConnection();
	}
	return $db;
}


function prepareSql($sql) {
	$pquery = getDb()->prepare($sql);
	return $pquery;
}

function executeSql($pquery, $fieldValueMapping) {
	$pquery->execute($fieldValueMapping);
	if (DEBUGGING == true) {
		echo var_dump(getDb()->errorinfo());
	}
	return $pquery;
}

?>

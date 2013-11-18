<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/*
 * Author:
 * - Steve Heller
 * - Patrice Keusch
 * - Rajeevan Rabeendran
 * - Mathias Weigert
 */

require_once 'model.php';
require_once 'controller.php';
require_once 'view.php';

$controller = new Controller($_POST,$_GET);

?>
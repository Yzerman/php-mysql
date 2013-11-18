<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "test";

$url ="http://localhost:8080/Uebung10_copied/resolver.php?service=kantone&methode=list";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$body = curl_exec($ch);
curl_close($ch);
// Via json
$json = json_decode($body);


echo "<br>";
echo "<br>";

$url ="http://localhost:8080/Uebung10_copied/resolver.php?service=kantone&methode=single&id=ZH";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$body = curl_exec($ch);
curl_close($ch);
// Via json
$json = json_decode($body);

echo "<br>";
echo "<br>";

$url ="http://localhost:8080/Uebung10_copied/resolver.php?service=kantone&methode=list&sort=Kanton";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$body = curl_exec($ch);
curl_close($ch);
// Via json
$json = json_decode($body);

?>
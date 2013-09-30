<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
$empfaenger = 'yzerman.detroit@bluewin.ch';
$betreff = 'Uebung3 - PHP-Kurs';
$nachricht = 'Hallo - Das ist die Uebungs-Nachricht';
$header = 'From: yzerman.detroit@bluewin.ch' . "\r\n" .
    'Reply-To: yzerman.detroit@bluewin.ch' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


mail($empfaenger, $betreff, $nachricht, $header);




?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Email-Send</title>
	</head>
			
	<body>
		<p>Das Mail wurde eventuell gesendet - wenn php so wollte.</p>
	</body>
</html>
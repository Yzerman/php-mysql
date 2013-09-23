<?php

    $drachne = 174123.25;
    $kurs = 50;
    $euro = 511;
    $sdrachne = "griechische Drachhmen";
    $seuro = "Euro";

    echo "<p> Peter sagt: 'Meine $drachne $sdrachne sind $euro $seuro wert.'" ;
    echo '<p> Peter sagt: \'Meine $drachne $sdrachne sind $euro $seuro wert.\'';
    echo '<p> Peter sagt: Meine '.$drachne.' '.$sdrachne.' sind '.$euro.' ' .$seuro.' wert';
?>
<?php

    $arr = array("Schweiz" => "Bern", "Frankreich" => "Paris", "Italien" => "Rom");

    $arr["England"] = "London";

    echo '<table border="1">';
    echo '<tr><td>Land</td><td>Haptstadt</td></tr>';
    foreach($arr as $country => $city){

        echo "<tr><td>$country</td><td>$city</td></tr>";

    }
    echo "</table>"

?>
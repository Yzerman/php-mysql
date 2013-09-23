<?php

$i = 11;

echo "<p> Note: ".$i. "<br>" ;
switch ($i) {
    case 1:  case 2:
        echo "Durchgefallen";
        break;
    case 3:
        echo "Fast geschafft";
        break;
    case 4:
    case 5:
        echo "nicht schlecht";
        break;
    case 6;
        echo "WOW";
        break;
    case $i > 6:
        echo "nicht bewertet";
        break;
    default:
       echo "keine Bewertung (Halbe noten)";
}
?>


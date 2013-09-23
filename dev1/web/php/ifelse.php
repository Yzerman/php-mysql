<?php

    $gewicht = 70;
    $XL = 60;
    $sXL = "XL (über 60kg).";

    echo "<p> Das Gepäck wiegt " .$gewicht. "kg.";
    echo "<p> Es gehört zur Kategorie ";

    if($gewicht>$XL):
        echo $sXL;
    elseif ($gewicht<$XL): {
        echo "<p> M";
    }
    endif;
    if($gewicht<$XL){
        echo "<p> Test";
    } else if ($gewicht>$XL){
        echo "<p> cool";
    }
    else  {

    }

    echo (4 < 12) ? " <p> Good morning!" : "<p> Good afternoon!";

?>

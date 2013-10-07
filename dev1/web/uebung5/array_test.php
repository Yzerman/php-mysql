<?php
ini_set('display_errors', '1');
    error_reporting(E_ALL);
$multiCity = array(
    array('City', 'Country', 'Continent'),
    array('Tokyo', 'Japan', 'Asia'),
    array('Mexico City','Mexico', 'North America'),
    array('New York City', 'USA', 'North America'),
    array('Mumbai', 'India', 'Asia'),
    array('Seoul', 'Korea', 'Asia'),
    array('Shanghai', 'China', 'Asia'),
    array('Lagos', 'Nigeria', 'Africa'),
    array('Buenos Aires', 'Argentina', 'South America'),
    array('Cairo', 'Egypt', 'Africa'),
    array('London', 'UK','Europe')
);
?>

<html>
<head>
<title>Multi-dimensional Array</title>
<style type="text/css">
td, th {width: 8em; border: 1px solid black; padding-left: 4px;}
th {text-align:center;}
table {border-collapse: collapse; border: 1px solid black;}
</style>
</head>
 <body>
<h2>Auflistung Array<br /></h2>
 <table>
    <thead>
        <?php
        //Erste Zeile ausgeben
        foreach ($multiCity[0] as $value){
                echo "<th>".$value."</th>";
            }
        ?>
    </thead>
    <tbody>
        <?php

            //Erste Zeile mit array_slice überspringen
            //Danach jede Zeile durchgehen
            foreach (array_slice($multiCity,1) as $value){
                echo "<tr>";
                echo "<td>".$value[0]."</td>";
                echo "<td>".$value[1]."</td>";
                echo "<td>".$value[2]."</td>";
                echo "</tr>";
            }

        ?>
    </tbody>

 </table>

<h2>Auflistung der St&auml;dte in Asien<br /></h2>

    <table>
        <thead>
            <tr>
                <?php
                    //Erste Zeile ausgeben
                    foreach ($multiCity[0] as $value){
                        echo "<th>".$value."</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                // Nur Zeilen mit "Asia" ausgeben
                foreach (array_slice($multiCity,1) as $value){
                    if ($value[2] == "Asia"){
                        echo "<tr>";
                        echo "<td>".$value[0]."</td>";
                        echo "<td>".$value[1]."</td>";
                        echo "<td>".$value[2]."</td>";  
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>


<h2>Auflistung der Kontinente, sowie die Zahl der L&auml;nder darin (im Array)<br /></h2>
<table>
    <tbody>
    <?php

    //Counterfunktion
    function array_value_count($searchString, $array){
        
        $count = 0;

        foreach ($array as $value){
            if ($value[2] == $searchString){
                $count++;
            }
        }
        return $count;
    }
    
    // Pro Kontinent die Counter Funktion aufrufen und ausgeben
    $asia = array_value_count("Asia",$multiCity);
    echo "<tr><td>Asia:</td><td>".$asia."</td></tr>";
    $northamerica = array_value_count("North America",$multiCity);
    echo "<tr><td>North America:</td><td>".$northamerica."</td></tr>";
    $africa = array_value_count("Africa",$multiCity);
    echo "<tr><td>Africa:</td><td>".$africa."</td></tr>";
    $southamerica = array_value_count("South America",$multiCity);
    echo "<tr><td>South America:</td><td>".$southamerica."</td></tr>";
    $europe = array_value_count("Europe",$multiCity);
    echo "<tr><td>Europe:</td><td>".$europe."</td></tr>";

    ?>
    </tbody>

</table>

<h2>Auflistung nach L&auml;nder A-Z <br /></h2>
<table>
    <tbody>
        <?php

                $tmp = Array();
                //Neues Array ohne die erste Zeile
                foreach(array_slice($multiCity,1) as $value){
                    $tmp[] = &$value[1];
                }
                //Sortieren nach Alphabet
                asort($tmp);
                foreach($tmp as $values){
                    echo "<tr>";
                    echo "<td>".$values."</td>";
                    echo "</tr>";
                }
                ?>
    </tbody>
</table>
</body>
</html>
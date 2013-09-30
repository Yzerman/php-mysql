<?php

        session_start();

        ini_set("display_errors", 1);
        error_reporting(E_ALL |  E_STRICT);

        if(isset($_GET['clearlist'])) {
            unset($_SESSION['personen']); // alternative: session_destroy();
            header('Location: session_handler.php'); // ugly redirect/refresh to unset ?clearlist
        }
        
        if(sizeof($_POST) > 0) {
            // write to session - uargh
            $_SESSION['personen'][] = array(
                                        'name' => htmlspecialchars($_POST['name']), 
                                        'alter' => htmlspecialchars($_POST['alter'])
                                    ) ;
        }
        
    ?>

    <form action="session_handler.php" method="post">
        <p>Ihr Name: <input type="text" name="name" value="voller Name"/></p>
        <p>Ihr Alter: <input type="text" name="alter" value="in Jahren" /></p>
        <p><input type="submit" value="Person eintragen" /></p>
    </form>

    <?php

        if(isset($_SESSION['personen'])) {
        
            echo '<table>' ;
            echo '<tr><th>Name</th><th>Alter</th></tr>' ;
            
            foreach($_SESSION['personen'] as $key=>$value) {
            
                echo '<tr><td>' . $value['name'] . '</td><td>' . $value['alter'] . '</td></tr>' ;
            
            }
            
            echo '</table>' ;
        
        }
        
    ?>
    <p>
        <a href="session_handler.php?clearlist">Personen-Liste leeren</a>
    </p>
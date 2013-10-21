<!DOCTYPE html>
<html>
  <head>
    <title>Uebung 6 - ToDo Liste</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <style>
        .todo{
            border: none;
        }
    </style>
  </head>
  <body>

      <div class="container">
        <h1>Uebung 6 - ToDo</h1>
        <p>
            <form class="form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <p class="name">
            <input type="text" name="text" id="name" placeholder="Neue ToDo" required />
            <input class="btn btn-default" type="submit" value="Add" />
        </p>
            </form>


        </p>
        <p>
            <p>
                Folgendes anzeigen:
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?show=todo">offene</a> -
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?show=done">erledigte </a> -
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?show=all">alle</a>
            </p>
            <table class="table">
                <thead>
                    <tr>

                        <th>Beschreibung</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($todo = $stms->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr>";
                            require 'todo.php';
                            if($todo['done']){
                                echo "<td><a type=\"button\" class=\"btn btn-warning\" href=\"" . $_SERVER['PHP_SELF'] . "?status=0&id=" . $todo['id'] . "\">doch nicht erledigt</a></td>";
                            }else{
                                echo "<td><a  type=\"button\" class=\"btn btn-success\" href=\"" . $_SERVER['PHP_SELF'] . "?status=1&id=" . $todo['id'] . "\">erledigen</a></td>";
                            }
                            echo "<td><a type=\"button\" class=\"btn btn-danger\" href=\"" . $_SERVER['PHP_SELF'] . "?delete=" . $todo['id'] . " \">löschen</a> </td>";
                            echo "</tr>";
                        }
                    ?>

                </tbody>

            </table>

        </p>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
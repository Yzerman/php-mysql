<?php include 'php/article.php';?>
<!doctype html>
<html lang="de-ch">

        <?php include 'php/header.php';?>

    <body>
        <div id="header">
    <header>
        <nav>

            <ul>
                <li><a class="redbutton" href="#">NAV1</a></li>
                <li><a class="redbutton" href="#">NAV2</a></li>
                <li><a class="redbutton" href="#">NAV3</a></li>
            </ul>

        </nav>

        

    </header>
    </div>
   <div id="content">
    <?php for ($i=0; $i < 5; $i++) { 
                    DrawArticle::drawOneArticle();
                }
                ?>

    <article>

    <p><?php include 'php/foreach.php';?>
    </article>

   </div>

   <div id="address">
        <address>
            <a href="http://www.google.ch"> Adressat</a>
        </address>

    </div>

    <?php include 'php/footer.php';?>

    </body>

</html>
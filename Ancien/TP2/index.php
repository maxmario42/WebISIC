<?php 
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    $pageToLoad="home.php";
    if(isset($_GET['page'])) 
        $pageToLoad=$_GET['page'].".php";
    if(isset($_GET['login'])&&isset($_GET['password']))
        $pageToLoad="connected.php";
    if(!is_readable($pageToLoad)) 
        $pageToLoad="error.php"; //!!
?> 
<!doctype html>
<html>
    <body>
        <?php require($pageToLoad); ?>
        <?php
            date_default_timezone_set("Europe/Paris"); 
            echo "Il est ".date("H:i:s"); 
        ?>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Acceuil</a>
                <li><a href="index.php?page=login">Login</a>
                <li><a href="index.php?page=error">Erreur</a>
            </ul>
        </nav>
    </body>
</html>
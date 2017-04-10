<?php

require_once "utility.php";

#Connection check
if(isset($_POST["user"]) && isset($_POST["password"]))
{
    $result = connect($entityManager, $_POST["user"], $_POST["password"]);

    if ($result == 0)
    {
        $_SESSION["isConnected"] = true;
        $_SESSION["user"] = $_POST["user"];
    }
}

?>


<html>
    <?php
    if ($_SESSION["isConnected"])
    {
        echo '
            <head>
                <title>Redirection | Module d\'aide</title>
                <meta http-equiv="refresh" content="1; URL=admin.php">
            </head>
            <body>
                Redirection en cours...
            </body>';
    }
    else
    {
        echo '
        <head>
            <title>Connection | Module d\'aide</title>
        </head>
        <body>
            <form action="" method="post">
                Identifiant:<br>
                <input type="text" name="user"><br>
                Mot de passe:<br>
                <input type="password" name="password"><br>
                <input type="submit">
            </form>
        </body>';
    }
    ?>
</html>

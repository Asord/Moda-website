<?php

require_once "utility.php";

function connect($entityManager, $name, $password)
{
	if (empty($name))
        return -1;
	if (empty($password))
        return -1;

	$list = sendRequest($entityManager, 'SELECT * FROM User u where u.user="'.$name.'"');

	if(is_null($list[0]))
        return -1;

	$hashPass = $list[0]['password'];

	if(sha1($password) == $hashPass)
        return 0;

	return -1;
}

if(isset($_POST["user"]) && isset($_POST["password"]))
{
    $result = connect($entityManager, $_POST["user"], $_POST["password"]);

    if ($result == 0)
    {
		// setcookie(isConnected, true, (time() + 3600) );
		// setcookie(user, $_POST["user"], (time() + 3600) );
        $_SESSION["isConnected"] = true;
        $_SESSION["user"] = $_POST["user"];
    }
}

?>

<!DOCTYPE HTML>

<HTML lang="fr">
    <?php
	// if (isset(&_COOKIE["isConnected"]) && $_COOKIE["isConnected"])
    if (isset($_SESSION["isConnected"]) && $_SESSION["isConnected"])
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
			<br><br><br>
            <center><form action="" method="post">
                Identifiant:<br>
                <input type="text" name="user"><br>
                Mot de passe:<br>
                <input type="password" name="password"><br>
                <input type="submit">
            </form></center>
        </body>';
    }
    ?>
</HTML>

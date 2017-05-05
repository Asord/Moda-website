<?php

require_once "utility.php";

/*
 * function connect
 * param: $entityManager -> the entityManager to interact with sql database
 * param: $name -> the username to find in sql database
 * param: &password -> password to identify user in sql database (codded in sha1)
 *
 * return: -1 if connection fail | 0 if connection success
 */
function connect($entityManager, $name, $password)
{
	if (empty($name))
        return -1;
	if (empty($password))
        return -1;

	// Request
	$list = sendRequest($entityManager, 'SELECT * FROM User u where u.user="'.$name.'"');

	if(is_null($list[0]))
        return -1;

	$hashPass = $list[0]['password'];

	if(sha1($password) == $hashPass)
        return 0;

	return -1;
}

#Connection check
if(isset($_POST["user"]) && isset($_POST["password"]))
{
    $result = connect($entityManager, $_POST["user"], $_POST["password"]);

    if ($result == 0)
    {
		/* setcookie(isConnected, true, (time() + 3600) );
		setcookie(user, $_POST["user"], (time() + 3600) ); */
        $_SESSION["isConnected"] = true;
        $_SESSION["user"] = $_POST["user"];
    }
}

?>

<html>
    <?php
	/* if (isset(&_COOKIE["isConnected"]) && $_COOKIE["isConnected"]) */
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

<?php
	
	require_once "bootstrap.php";
	
	// Utilisation d'une connection native car impossible de trouver comment créer une base avec doctrine ou symphony
	$connection = new mysqli($conn["host"], $conn["user"], $conn["password"]);
	if ($connection->connect_error)
	{
		die("Connection failed: ".$connection->connect-error);
	}
	
	$sql = "CREATE DATABASE ".$conn["dbname"];
	if($connection->query($sql) === true)
	{
		echo "Database created sucessfully";
	}
	else
	{
		echo "Error creating database: " . $connection->error;
	}
	
	$connection->close();
	
	// Exécution de la création des tables de données
	exec("php vendor\doctrine\orm\bin\doctrine orm:schema-tool:create");
	
	header('Location:index.php');
	unlink('install.php');
    exit();
?>
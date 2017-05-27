<?php
    require_once "utility.php";
    require_once "template.php";
	require_once "imageForm.php";
	
	if (!isset($_SESSION["isConnected"]) || $_SESSION["isConnected"] != true)
	{
		header('Location:connect.php');
        exit();
	}
	
	$content = "";
	
		
	// Forms
	if(isset($_FILES["image"]) && !empty($_FILES["image"]))
	{
		$file = uploadImage($_FILES["image"]);
		if ($file !== -1)
		{
			$content = uploadSucessContent($file);
			print_r($content);
		}
	}
	elseif( isset($_POST["delete"]) && !empty($_POST["delete"]) )
	{
		if(file_exists($_POST["delete"]))
		{	
			unlink($_POST["delete"]);
			$content = getDefaultContent();
		}
		else
		{
			$content = getErrorContent();
		}
	}
	elseif( isset($_GET["path"]) && !empty($_GET["path"]) )
	{
		$content = getImageContent($_GET["path"]);
	}
	else
	{
		$content = getDefaultContent();
	}
	
/* HTML */
echo getAdminHeader("Gestion d'images - Module d'aide");
echo '<a id="disconect" href="deconect.php">Déconection.</a>';
echo $content;
echo'</body></html>';
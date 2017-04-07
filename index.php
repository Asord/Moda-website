
<?php 
    /* session variables: 
     * isConnected: bool (define if a current user is connected)
     */
	session_start();

	require_once "pageManager.php";
    require_once "template.php";

    // Page data -> 0: page title | 1: page content
	$page = [];

	// if an user and a password is defined as post variables
	if(isset($_POST["user"]) && isset($_POST["password"]))
	{
		$result = connect($entityManager, $_POST["user"], $_POST["password"]);
        
        if ($result == 0)
		  $_SESSION["isConnected"] = true;
	}

    // If there is no connection yet
	if (!isset($_SESSION["isConnected"]) || $_SESSION["isConnected"] != true)
	{
		$page = defaultConnectionPage();
	}
	else
	{
        // If a title and a content is defined by post (a new page creation request)
		if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["content"]) && !empty($_POST["content"]) )
		{
			createPage($entityManager, $_POST["title"], $_POST["content"]);
            echo "page sucessfully created.";
			$page = defaultPage();
		}
        
        // If a id is defined by get (page request)
		elseif (isset($_GET["id"]) && !empty($_GET["id"]))
		{
			$page = getPage($entityManager, $_GET["id"]);
		}
        
        // if list is set by get (pages list request)
		elseif (isset($_GET["list"]))
		{
			$page = listPages($entityManager);
		}
        
        // if edit is set and has a page id
        elseif (isset($_GET["edit"]) && !empty($_GET["edit"]))
        {
            $page = editPage($entityManager, $_GET["edit"]);   
        }
        
        // if delete is defined by get (page deletion request)
		elseif (isset($_GET["delete"]) && !empty($_GET["delete"]))
		{
			deletePage($entityManager, $_GET["delete"]);
            echo "page sucessfully deleted.";
			$page = defaultPage();
		}
        
        // if nothing is defined, page is a default page
		else
		{
			$page = defaultPage();
		}
	}

	$title = $page[0];
	$content = $page[1];
?>


<!DOCTYPE HTML>

<HTML lang="fr">
	<head> 
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<!--<link rel="stylesheet" href="style.css" />-->
		<?php echo $title ?>
		<style type="text/css">
			.main {
				text-align: center;
				padding: 0 20px;
			}
			form {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<a href="disconect.php">Déconection.</a>
		<?php /* php page builder */
            echo getHeader();
            echo $content;
        ?>
	</body>
</html>


<?php
    require_once "utility.php";
	require_once "articleManager.php";
	require_once "articleform.php";
    require_once "template.php";

	if (!isset($_SESSION["isConnected"]) || $_SESSION["isConnected"] != true)
	{
		header('Location:connect.php');
        exit();
	}
	
	$form = [];
	
	$create = false;
	$delete = 0;
	$edit = 0;

	// zone de récupération des éléments post
	if (isset($_POST["create"]))
	{
		$create = true;
	}
	if( isset($_POST["edit"]) && !empty($_POST["edit"]) )
	{
		$edit = $_POST["edit"];
	}
	if( isset($_POST["delete"]) && !empty($_POST["delete"]) )
	{
		$delete = $_POST["delete"];
		$edit = 0;
	}
	
	
	if($edit != 0 || $create)
	{                            
		$list = array(
			"title" => "Pas de titre",
			"imageLink" => "image/default.png",
			"author" => "inconnu",
			"contrib" => "",
			"tags" => "404",
			"content" => "Pas de contenu"
		);
		
		if(isset($_POST["title"]) && !empty($_POST["title"]))
		{
			$list["title"] = $_POST["title"];
		}
		if($create)
		{
			if(isset($_FILES["image"]) && !empty($_FILES["image"]))
			{
				$image_link = uploadImage($_FILES["image"]);
				if ($image_link !== -1)
				{
					$list["imageLink"] = $image_link;
				}
			}
		}
		else
		{
			if(isset($_POST["imageLink"]) && !empty($_POST["imageLink"]))
			{
				$list["imageLink"] = $_POST["imageLink"];
			}
		}
		if(isset($_POST["author"]) && !empty($_POST["author"]))
		{
			$list["author"] = $_POST["author"];
		}
		if(isset($_POST["contrib"]) && !empty($_POST["contrib"]))
		{
			$list["contrib"] = $_POST["contrib"];
		}
		if(isset($_POST["tags"]) && !empty($_POST["tags"]))
		{
			$list["tags"] = $_POST["tags"];
		}
		if(isset($_POST["content"]) && !empty($_POST["content"]))
		{
			$list["content"] = $_POST["content"];
		}
		
		if($create)
			createArticle($entityManager, $list);
		else
			editArticle($entityManager, $edit, $list);
		
	}
	if ($delete != 0)
	{
		deleteArticle($entityManager, $delete);
	}
	
	// Zone de récupération des éléments GET pour récupération des éléments form
	if( isset($_GET["create"]) && $create == false)
	{
		$form = createArticleForm();
	}
	elseif( isset($_GET["edit"]) && !empty($_GET["edit"]) && $edit == 0 && $delete == 0)
	{
		$form = editArticleForm($entityManager, $_GET["edit"]);
	}
	else
	{
		$form = getListArticleForm($entityManager);
	}
	
	$title = $form[0];
	$content = $form[1];

/* HTML */
echo getAdminHeader($title, '<script src="./ckeditor/ckeditor.js"></script>');
echo '<a id="disconect" href="deconect.php">Déconection.</a>';
echo $content;
echo '</body></html>';
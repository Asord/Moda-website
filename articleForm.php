<?php

require_once "utility.php";

$chEditorScript = '';

function createArticleForm()
{
	$title = 'Créer un article - Module d\'aide';
	$content = 
		'<div class="container">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2">
						Titre de l\'article: <input type="text" name="title">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						Image de l\'article: <input type="file" name="image" accept="image/*">
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9">
						<center>Contenu de l\'article:</center>
						<textarea name="content" id="content" rows="10" cols="100"></textarea>
						<script>CKEDITOR.replace(\'content\');</script>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2">
						Auteur de l\'article:<br><input type="text" name="author"><br>
						Contributeurs de l\'article:<br><input type="text" name="contrib"><br>
						Tags de l\'article:<br><input type="text" name="tags"><br>
						<center><br><br><input type="submit" value="Créer"></center>
						<input type="hidden" name="create">
					</div>
				</div>
			</form>
		</div>';
	return [$title, $content];
}

function getArticleFormList($entityManager, $id)
{
	$article = $entityManager->find("Article", (int)$id);
    
	if (is_null($article))
		return array(
			"title"=>"Erreur: article non trouvé", 
			"imageLink"=>"images/article404.png",
			"content"=>"Une erreur c'est produite lors de la récupération de l'article.",
			"author"=>"",
			"contrib"=>"",
			"tags"=>"404"
		);

	return array(
		"title"=>$article->getTitle(), 
		"imageLink"=>$article->getImageLink(),
		"content"=>$article->getContent(),
		"author"=>$article->getAuthor(),
		"contrib"=>$article->getContrib(),
		"tags"=>$article->getTags()
	);
}

function editArticleForm($entityManager, $id)
{
    $article = getArticleFormList($entityManager, $id);
    
	if ($article['tags'] == '404')
	{
		$title = 'Erreur 404 - Module d\'aide';
		$content = "L'article que vous avez demandé semble ne pas exister.";
	}
	else
	{
		$title = 'Editer une page - Module d\'aide';
		$content = 
			'<div class="container">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2">
							Titre de l\'article: <input type="text" name="title" value="'.$article["title"].'">
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							Image de l\'article: <br><input type="text" name="imageLink" value="'.$article["imageLink"].'">
							<a target="_blank" href="'.$article["imageLink"].'"> cliquez ici pour voire l\'image</a>
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-9">
							<center>Contenu de l\'article:</center>
							<textarea name="content" id="content" rows="10" cols="100" >'.$article["content"].'</textarea>
							<script>CKEDITOR.replace(\'content\');</script>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							Auteur de l\'article:<br><input type="text" name="author" value="'.$article["author"].'"><br>
							Contributeurs de l\'article:<br><input type="text" name="contrib" value="'.$article["contrib"].'"><br>
							Tags de l\'article:<br><input type="text" name="tags" value="'.$article["tags"].'"><br>
							<input type="hidden" name="edit" value="'.$id.'">
							<center><br><br><input type="submit" value="Enregistrer"></center>
						</div>
					</div>
				</form>
				<form action="" method="post">
				<input type="hidden" name="delete" value="'.$id.'">
					<br><input id="delArticle" type="submit" value="Supprimer l\'article">
				</form>
			</div>';
	}
	return [$title, $content];
}

function getDefaultForm()
{
	$title = 'Administration - module d\'aide';
	$content = '
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4"></div>
				<div class="col-lg-4 col-md-4 col-sm-4"><center>
					<br><br>
					<a id="new" href="?create">Cliquez ici pour créer un nouvel article.</a>
				</center></div>
			</div>
		</div><br>';
	return [$title, $content];
}

function getListArticleForm($entityManager)
{
	$list = sendRequest($entityManager, "SELECT id FROM Article");
	
	$tmp = getDefaultForm();
	
	if( count($list) == 0)
	{
		return $tmp;
	}

	$title = $tmp[0];
	$content = $tmp[1];
	
	$content .= 
		'<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4"></div>
				<div class="col-lg-4 col-md-4 col-sm-4"><center>
					Cliquez sur un article pour l\'éditer:<br>';
				
	foreach($list as $data)
	{
		$article = $entityManager->find("Article", (int)$data["id"]);
		$content .= 
					'<a target="_blank" href="?edit='.$article->getId().'">
						<img src="'.$article->getImageLink().'">
						<p>'.$article->getTitle().'</p>
					</a><br><br>';
	}
	$content .= '
				</center></div>
			<div class="col-lg-4 col-md-4 col-sm-4"></div>
		</div>';
	
	return [$title, $content];
}
?>
























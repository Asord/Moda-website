<?php

require_once "utility.php";

function getErrorContent()
{
	return '<div class="container">
				<div class="row">
					<center>
						<p> Erreur: le fichier n\'existe pas.</p>
					</center>
				</div>
			</div>';
}

function uploadSucessContent($file)
{
	return '<meta http-equiv="refresh" content="1; url=?path='.$file.'" />
	<div class="container">
				<div class="row">
					<center>
						<p> Le fichier à bien été envoyé sur le serveur.</p>
					</center>
				</div>
			</div>';
}

function getImageContent($path)
{
	if(file_exists($path))
	{
		return '<div class="container">
					<div class="row">
						<center>
							<a target="_blank" href="'.$path.'"><img src="'.$path.'"></a><br><br>
							Lien de l\'image: <input type="text" value="'.$path.'" size="65">
							<form action="" method="post">
							<input type="hidden" name="delete" value="'.$path.'">
							<input type="submit" value="Supprimer">
							</form>
						</center>
					</div>
				</div>';
	}
	else
		return getErrorContent();
}

function getDefaultContent()
{
	return  '<div class="container">
				<div class="row">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="col-lg-3 col-md-3 col-sm-3"></div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<center>
								Image à envoyer: <br><br><input type="file" name="image" accept="image/*"><br>
								<input type="hidden" name="upload">
								<input type="submit" value="Envoyer"><br><br>
							</center>
						</div>
					</form>
					'.getAllUploadedImagesContent().'
				</div>
			</div>';
}

function getAllUploadedImagesContent()
{
	$imagesPaths = scandir("images/upload/");
	$content = 
		'<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4"></div>
			<div class="col-lg-4 col-md-4 col-sm-4"><center>
				Liste des images déjà présentes:<br>';
				
	foreach($imagesPaths as $image)
		if($image != "." && $image != "..")
		{
			$path = "images/upload/" . $image;
			$content .= 
				'<a target="_blank" href="?path='.$path.'">
					<img src="'.$path.'">
				</a><br><br>';
		}
	
	$content .= 
		'	</center></div>
			<div class="col-lg-4 col-md-4 col-sm-4"></div>
		</div>';
	
	return $content;
}


?>
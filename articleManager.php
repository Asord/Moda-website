<?php

require_once "utility.php";

// list: [title, image_link, content, credit_author, credit_contrib, tags]
function createArticle($entityManager, $list)
{
	$article = new Article();
	$article->setTitle($list["title"]);
	$article->setImageLink($list["imageLink"]);
	$article->setContent($list["content"]);
	$article->setAuthor($list["author"]);
	$article->setContrib($list["contrib"]);
	$article->setTags($list["tags"]);

	$entityManager->persist($article);
	$entityManager->flush();
	
	return 0;
}

function getArticle($entityManager, $id)
{
	$article = $entityManager->find("Article", (int)$id);
    
	if (is_null($article))
		return null;

	return $article;
}

function editArticle($entityManager, $id, $list)
{
    $article = getArticle($entityManager, $id);
    
	if (is_null($article))
		return -1;
	else
	{
		$article->setTitle($list["title"]);
		$article->setImageLink($list["imageLink"]);
		$article->setContent($list["content"]);
		$article->setAuthor($list["author"]);
		$article->setContrib($list["contrib"]);
		$article->setTags($list["tags"]);

		$entityManager->persist($article);
		$entityManager->flush();
	}
	return 0;
}

function deleteArticle($entityManager, $id)
{
	$article = $entityManager->find("Article", (int)$id);
    
	if (is_null($article))
	{
		return -1;
	}
	
	$entityManager->remove($article);
	$entityManager->flush();
    return 0;
}

?>

<?php

require_once "utility.php";


/*
 * function defaultPage
 *
 * return: array page[title, content]
 */
function create_page()
{
	$title = 
		'<title>Créer une page - Module d\'aide</title>';
	$content = 
		'<form action="" method="post">
			Titre du poste:<br><input type="text" name="title"><br>
			Contenu du poste:<br><textarea name="content" rows=4 cols=50></textarea><br>
			<input type="submit">
		</form>';

	return [$title, $content];
}

/*
 * function defaultPage
 *
 * return: array page[title, content]
 */
function editPage($entityManager, $id)
{
    $page = getPage($entityManager, $id);
    
	$title = 
		'<title>Editer une page - Module d\'aide</title>';
	$content = 
		'<form action="" method="post">
			Titre du poste:<br><input type="text" name="title" value="'.$page[0].'"><br>
			Contenu du poste:<br><textarea name="content" rows=4 cols=50 value="'.$page[1].'"></textarea><br>
			<input type="submit">
		</form>';

	return [$title, $content];
}

/*
 * function createPage
 * param: $entityManager -> the entityManager to interact with sql database
 * param: $title -> title of the new page to create
 * param: $content -> content of the new page to create
 */
function createPage($entityManager, $title, $content)
{
	$page = new Page();
	$page->setTitle($_POST["title"]);
	$page->setContent($_POST["content"]);

	$entityManager->persist($page);
	$entityManager->flush();
}

/*
 * function getPage
 * param: $entityManager -> the entityManager to interact with sql database
 * param: id: the page id to get
 *
 * return: array page[title, content]
 */
function getPage($entityManager, $id)
{
	// Get the page content by id
	$page = $entityManager->find("Page", (int)$id);
    // if the page does not exist
	if (is_null($page))
	{ 
        // TODO: créer une page modèle 404
		return defaultPage();
	}

	// page content from sql database
	$title = '<title>'.$page->getTitle().'</title>';
	$content = $page->getContent();

	return [$title, $content];
}

/*
 * function listPages
 * param: $entityManager -> the entityManager to interact with sql database
 *
 * return: array page[title, content]
 */
function defaultPage($entityManager)
{
    // send a sql request to entityManager
	$list = sendRequest($entityManager, "SELECT id FROM Page");

	$title = "<title>Liste des pages - Module d\'aide</title>";
	$content = "<center><table>";
    
    // If there is no page, invite admin to create some insteed.
    if(count($list) == 0)
    {
        $content .= '
            <tr>
                <td>
                    <p>Aucune pas n\'existe pour le moment. Créez-en une en cliquant sur "Créer une page"</p>
                </td>
            </tr></table></center>';
        return [$title, $content];
    }

    // For each pages
	foreach ($list as $row)
		{ 
            // concatenate content
            $content .= '
                <tr>
                    <td>
                        <a href="index.php?id='.$row["id"].'">'.$row["id"].'</a>
                    </td>
                </tr>';
        }
	$content .= '</table></center>';

	return [$title, $content];
}

/*
 * function deletePage
 * param: $entityManager -> the entityManager to interact with sql database
 * param: $id -> the page id to delete
 *
 * return: -1 if page doesn't exist | 0 if page sucessfully deleted
 */
function deletePage($entityManager, $id)
{
    // find the page from sql database
	$page = $entityManager->find("Page", (int)$id);
    
    // if the page exist
	if (!is_null($page))
	{
		$entityManager->remove($page);
		$entityManager->flush();
        return 0;
	}
    return -1;
}

?>

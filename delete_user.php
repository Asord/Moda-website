<?php
// delete_user.php <id>
require_once "bootstrap.php";

$id = htmlspecialchars($_POST["id"]);
$user = $entityManager->find('User', $id);

if ($user === null) {
    echo "No user found.\n";
    exit(1);
}
$entityManager->remove($user);
$entityManager->flush();

echo 'Le contenu de la base de donn&eacutees a bien &eacutet&eacute modifi&eacute.';
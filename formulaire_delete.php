<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Suppression</title>
		<link rel="stylesheet" href="./css/styles.css" />
	</head>
	<body>
	Vous allez supprimer cette personne de la base de donn&eacutees... </br></br>
		<form action="delete_user.php" method="post">
			<?php
				require_once "bootstrap.php";
				$id = htmlspecialchars($_GET["id"]);
				$user = $entityManager->find('User', $id);

				if ($user === null) {
					echo "No user found.\n";
					exit(1);
				}
				echo '<input type="hidden" name="id" value="' . $id . '" />';
				echo 'Username : ' . $user->getUser() . '</br>';
			?>
			</br>
			<input type="submit" value="Supprimer">
		</form>
	</body>
</html>
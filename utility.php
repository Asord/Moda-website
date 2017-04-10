<?php
/* session variables:
 *    isConnected: bool (define if a current user is connected)
 */
session_start();

require_once "bootstrap.php";

function sendRequest($entityManager, $request)
{
	$emr = $entityManager->getConnection()->prepare($request);
	$emr->execute([]);
	$list = $emr->fetchAll();

	return $list;
}
?>

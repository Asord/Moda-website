<?php


function sendRequest($entityManager, $request)
{
	$emr = $entityManager->getConnection()->prepare($request);
	$emr->execute([]);
	$list = $emr->fetchAll();

	return $list;
}
?>
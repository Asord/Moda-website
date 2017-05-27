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

function uploadImage($image)
{
	$target_dir = "./images/upload/";
	
	$check = getimagesize($image["tmp_name"]);
	if ($check === false)
		return -1;
	
	if ($image["size"] > 5000000)
		return -1;

	$ext = pathinfo(basename($image["name"]), PATHINFO_EXTENSION);
	
	do{
		$file_name = substr(md5($image['name'].time()), 5, 15).".".$ext;
		$target_file = $target_dir . $file_name;
	} while(file_exists($target_file));

	if(move_uploaded_file($image["tmp_name"], $target_file))
		return $target_file;
	
	return -1;
}

?>

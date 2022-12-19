<?php
	require('./inc/headers.php');
	require_once 'inc/functions.php';
	
	global $json;
	
	$db = openSQLite();
	
	if (isset($_GET["action"])) {
		$action = $_GET["action"];
		
		switch ($action) {

			case "getCats":
				$query = 'select id,username,name,breed,age,sex,details,sterilization from cats';
			break;
			
			case "getUsers":
				$query = 'select username from user';
			break;
			
			
		} try {
			$json = selectAsJson($db, $query);
			$json = json_encode($json);
			echo $json;
		} catch (PDOException $pdoex) {
			returnError($pdoex);
		}
	} else {
		http_response_code(400);
		echo "no action";
	}
?>
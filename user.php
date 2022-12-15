<?php
	require('./inc/headers.php');
	require_once('./inc/functions.php');

    $db = openSQLite();

	if (isset($_GET["action"])) {
		$action = $_GET["action"];
		
		switch ($action) {

			case "loginSession":
				session_start();
				if (isset($_SESSION['username'])) {
					http_response_code(200);
					echo "Logged in through session: " . $_SESSION['username'];
					return;
				} else {
					echo "Not logged in";
				}
				break;
                  
			case "login":
				if (
					isset($_POST["username"]) &&
					isset($_POST['passwd'])
				) {
					$password = urlencode($_POST['passwd']);
					$username = urlencode($_POST['username']);
					
					$query = "SELECT passwd from USER where username = '" . $username ."'";
					$hash = selectAsJson($db, $query);
					if (count($hash) == 1) {
						$hash = $hash[0]["passwd"];
						if (password_verify($_POST['passwd'], $hash)) {
							session_start();
							$_SESSION['username'] = $_POST["username"];
							$data["username"] = $_POST["username"];
							$data["loginSuccess"] = true;
							$data = json_encode($data);
							echo $data;
							http_response_code(200);
						} else {
							echo header('HTTP/1.1 500 Internal server Error');
							echo "Internal server error";
						}
					} else {
						echo "Wrong username or password";
					}
				} else {
					echo "Login failed, missing details.";
				}
				break;
			case "logout":
				session_start();
				unset($_SESSION["username"]);
				http_response_code(200);
				echo "You  have logged out";
        } 
    } else {
		echo "no action";
	}
?>
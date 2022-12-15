<?php
require('./inc/headers.php');
require_once('./inc/functions.php');

$db = openSQLite();


$username = urlencode($_POST["username"]);
$checkUserExist = "select * from user where (username = '" . $username . "')";
$checkUserExist = selectAsJson($db, $checkUserExist);
if (count($checkUserExist) != 0) {                 
    http_response_code(409);
    echo json_encode("Username already exists in the database");
     return;
        } else {
            $hash = password_hash(urlencode($_POST["passwd"]),PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (username, passwd) VALUES ('$username', '$hash'); ";
            try {
                executeInsert($db, $sql);
                echo json_encode('Username created');
                http_response_code(200);
                } catch (Exception $e) {
                    echo "Failed";
                    print_r($e);
                    }
                }
                    
?>
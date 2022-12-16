<?php
require('./inc/headers.php');
require_once 'inc/functions.php';


$db = openSQLite();

session_start();


if (isset($_SESSION["username"])) {

    $getAdminlevel = "select level from ADMIN where (username = '" . $_SESSION["username"] . "')";
    $getAdminlevel = selectAsJson($db, $getAdminlevel);


    if (count($getAdminlevel) > 0) {

        if (!isset($_GET["action"])) {
            http_response_code(400);
            echo('no action');
            return;
        }


        if (isset($_GET["action"])) {
            $action = $_GET["action"];

            switch($action) {
                case "addCats":
                    $id = $_POST['id'];
                    $username = $_POST['username'];

                    $sql = "INSERT INTO cats (name,breed,age,sex,details,sterilization) VALUES ('$id','$username','$name', '$breed','$age','$sex','$details','$sterilization'); ";

                    try {
                        executeInsert($db, $sql);
                        echo json_encode('Adoptive cat added to the database successfully');
                    } catch (PDOException $pdoex) {
                        returnError($pdoex);
                        echo "Failed";
                    }
                break;

                case "deleteCats":
                    $id = $_POST['id'];

                    $sql = "DELETE FROM cats WHERE id = '$id' ";

                    try {
                        executeInsert($db, $sql);
                        echo json_encode('Cat' . $id ."  deleted successfully from the database");
                    } catch (PDOException $pdoex) {
                        returnError($pdoex);
                        echo "Failed";
                    }
                break;
             
                case "getLevel":
                    http_response_code(200);
                    echo json_encode(['User is an admin', true, 'isAdmin', $getAdminlevel]);
                    return;
                break;
            }
        }   
    } else {
        http_response_code(401);
        echo "You are not an admin, you need admin permissions.";
        return;
    }  
} else { 
    http_response_code(401);
    echo "You are not logged in.";
    return;
}       
                    
?>
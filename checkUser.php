<?php
include('connection.php');
include('headers.php');
if(count($_POST) == 2) {
    $query = "SELECT * FROM `users` where username = '".$_POST['username']."' and password = '".md5($_POST['password'])."';";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $row = mysqli_fetch_array(mysqli_query($con, $query));
            $content = array(
                    "username" => $row['username'],
                    "firstName" => $row['firstName'],
                    "lastName" => $row['lastName'],
                    "userType" => $row['userType'],
                    "id" => $row["id"],
                    "bday" => $row["birthDay"]
            );
            $response = array("response" => "ok", "error" => "null", "content" => $content);
            echo json_encode($response, JSON_PRETTY_PRINT);
            //echo json_encode(mysqli_fetch_array(mysqli_query($con, $query)));
        }
    } catch(Exception $e) {
        $response = array("response" => "failed", "error" => $e->getMessage(), "content" => "");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

} else {
    $response = array("response" => "failed", "error" => "Missing data", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
    //echo json_encode($_POST);
}
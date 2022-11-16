<?php
include('connection.php');
include('headers.php');
if(count($_POST) == 7) {
    $bday = strtotime($_POST["bday"]);
    $bday = date('Y-m-d H:i:s', $bday);
    $query = "INSERT INTO users values ('".$_POST['username']."', '".md5($_POST['password'])."', '".$_POST['firstName']."','".$_POST['lastName']."', ".$_POST['userType'].",".$_POST['id'].",'".$bday."')";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = array("response" => "ok", "error" => "null", "content" => "user inserted");
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } catch(Exception $e) {
        $response = array("response" => "failed", "error" => $e->getMessage(), "content" => "");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

} else {
    $response = array("response" => "failed", "error" => "Missing data", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
}
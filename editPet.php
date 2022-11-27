<?php
include('connection.php');
include('headers.php');
if (count($_POST) == 5) {
    //code for inserting pet
    $query = "UPDATE pets SET name='{$_POST['name']}', race='{$_POST['race']}', sex='{$_POST['sex']}', age ='{$_POST['age']}' where ID = {$_POST['ID']} ";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = array("response" => "ok", "error" => "null", "content" => "pet edited");
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } catch(Exception $e) {
        $response = array("response" => "failed", "error" => $e->getMessage(), "content" => "");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    $response = array("response" => "failed", "error" => "Missing data from request", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
}
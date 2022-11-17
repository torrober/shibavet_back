<?php
include('connection.php');
include('headers.php');
if (count($_POST) == 5) {
    //code for inserting pet
    $query = "INSERT INTO pets (name, race, age, sex, ownerID) values ('{$_POST['name']}', '{$_POST['race']}', {$_POST['age']}, '{$_POST['sex']}', {$_POST['ownerID']})";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = array("response" => "ok", "error" => "null", "content" => "pet inserted");
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
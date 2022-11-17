<?php
include('connection.php');
include('headers.php');
if (count($_POST) == 5) {
    //code for inserting pet
} else {
    $response = array("response" => "failed", "error" => "Missing data from request", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
}
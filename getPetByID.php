<?php
include('connection.php');
include('headers.php');
if (count($_POST) == 1) {
    //code for inserting pet
    $query = "SELECT * from pets WHERE ID = '{$_POST['ID']}'";
    $result = mysqli_query($con, $query);
    $content = array();
    try {
        if (!$result) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            //$response = array("response" => "ok", "error" => "null", "content" => "pet inserted");
            //echo json_encode($response, JSON_PRETTY_PRINT);
            if (mysqli_num_rows($result) > 0) {
                
                $response = array("response" => "ok", "error" => "", "content" => mysqli_fetch_assoc($result));
            } else {
                $response = array("response" => "failed", "error" => "Pet does not exist", "content" => "");
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } catch (Exception $e) {
        $response = array("response" => "failed", "error" => $e->getMessage(), "content" => "");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    $response = array("response" => "failed", "error" => "Missing data from request", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
}

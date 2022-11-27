<?php
include('connection.php');
include('headers.php');
if(count($_POST) >= 4) {
    $bday = strtotime($_POST["date"]);
    $bday = date('Y-m-d H:i:s', $bday);
    $query = "INSERT INTO clinicalhistory values ('{$bday}','{$_POST['petID']}', '{$_POST['ownerID']}','{$_POST['sickness']}', '{$_POST['details']}')";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = array("response" => "ok", "error" => "null", "content" => "record inserted");
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
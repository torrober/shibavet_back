<?php
include('connection.php');
include('headers.php');
if(count($_POST) == 4) {
    $bday = strtotime($_POST["bday"]);
    $bday = date('Y-m-d H:i:s', $bday);
    $query = "INSERT INTO services (date, serviceType, ownerID, petID) values ('".$_POST['date']."', '".$_POST['serviceType']."', '".$_POST['ownerID']."','".$_POST['petID']."')";
    try {
        if(!mysqli_query($con, $query)) {
            $response = array("response" => "failed", "error" => mysqli_error($con), "content" => "");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = array("response" => "ok", "error" => "null", "content" => "service inserted");
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } catch(Exception $e) {
        $response = array("response" => "failed", "error" => $query, "content" => "");
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

} else {
    $response = array("response" => "failed", "error" => "Missing data from request", "content" => []);
    echo json_encode($response, JSON_PRETTY_PRINT);
}
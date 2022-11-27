<?php
include('connection.php');
include('headers.php');
if ($_POST['userType'] == '2' && isset($_POST['petID'])) {
    //code for inserting pet
    $query = "SELECT * from clinicalhistory where petID = {$_POST['petID']}";
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
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row;
                    array_push($content,$row);
                }
                $response = array("response" => "ok", "error" => "", "content" => $content);
            } else {
                $response = array("response" => "failed", "error" => "No reports found", "content" => "");
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

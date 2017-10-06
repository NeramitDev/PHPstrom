<?php
/**
 * Created by PhpStorm.
 * User: Neramit777
 * Date: 10/4/2017
 * Time: 11:28 AM
 */

// Set time zone to Bangkok in Asia ----------------------------------------------------------------------------------------------------------------------------------
date_default_timezone_set('Asia/Bangkok');

// Tell header for content-type is json format -----------------------------------------------------------------------------------------------------------------------
header('Content-Type: application/json');

// Declare variables -------------------------------------------------------------------------------------------------------------------------------------------------
$token = $_SESSION['token'];
$jsonR = $_SESSION['data'];
$friendUsername = $jsonR['username'];

$Data = new \stdClass();
$data = new \stdClass();

require_once('CheckToken.php');
if ($checkToken == 1) {
    $username = $name;
    require_once('DBconnect.php');
    $sql = "UPDATE friends SET friendStatus = 1 WHERE BINARY ownerUsername = '$friendUsername' AND BINARY friendUsername = '$username'";
    if ($con->query($sql) == TRUE) {
        $Data->status = 200;
        $Data->message = "Accept friend successful!";
        $Data->data = $data;
    } else {
        $Data->status = 402;
        $Data->message = "Accept friend failed.";
    }

} else {
    $Data->status = 400;
    $Data->message = "Wrong token.";
}

// Retrieve value json format to client ------------------------------------------------------------------------------------------------------------------------------
$retrieve_json = json_encode($Data);
echo $retrieve_json;

// Close table DB & session ------------------------------------------------------------------------------------------------------------------------------------------
mysqli_close($con);
session_write_close();
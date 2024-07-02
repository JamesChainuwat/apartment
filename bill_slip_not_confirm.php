<?php
    session_start();
    include "connect.php";

    $id = $_POST['id'];

    $query = exceData("UPDATE `tbl_room_bill` SET `bill_status` = '0' WHERE `bill_id` = '$id'");

    if($query) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
?>
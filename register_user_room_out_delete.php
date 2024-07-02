<?php
    session_start();
    include "connect.php";

    $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
    $out_in_date = mysqli_real_escape_string($conn, $_POST["out_in_date"]);
    $room_id = mysqli_real_escape_string($conn, $_POST["room_id"]);


    $query = exceData("UPDATE `tbl_user` SET `end_date` = '$out_in_date' WHERE `user_id` = '$user_id'");

    $query2 = exceData("UPDATE `tbl_user` SET `u_status` = '0' WHERE `tbl_user`.`user_id` = '$user_id'");

    $query3 = exceData("UPDATE `tbl_room` SET `ro_id` = '1' WHERE `room_id` = '$room_id'");

    header('location:register_user_room_out.php');

?>
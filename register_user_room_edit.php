<?php
    session_start();
    include "connect.php";

    $room_id = mysqli_real_escape_string($conn, $_POST["room_name"]);
    $move_in_date = mysqli_real_escape_string($conn, $_POST["move_in_date"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["tenant_name"]);
    $user_id_old = mysqli_real_escape_string($conn, $_POST["user_id_old"]);

    $old_user = getData("SELECT * FROM `tbl_user` where user_id = $user_id_old");

    if($old_user['0']['user_id'] == $user_id){
        $old_room_id = $old_user['0']['room_id'];

        if($old_room_id != $room_id){
            $update_room = exceData("UPDATE `tbl_room` SET `ro_id`='2' WHERE room_id = '$room_id';");
            $update_room = exceData("UPDATE `tbl_room` SET `ro_id`='1' WHERE room_id = '$old_room_id';");
        }

        $update_old_user = exceData("UPDATE `tbl_user` SET `room_id` = '$room_id', `stay_date` = '$move_in_date' WHERE `user_id` = '$user_id_old'");

        echo "<!DOCTYPE html>
        <html>
        <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'แก้ไขลงทะเบียนย้ายเข้าเรียบร้อย',
                text: 'เรียบร้อย',
            }).then(function() {
                window.location = 'register_user_room.php';
            });
        </script>
        </body>
        </html>";
    }else{
        $old_room_id = $old_user['0']['room_id'];
        
        if($old_room_id != $room_id){
            $update_room = exceData("UPDATE `tbl_room` SET `ro_id`='2' WHERE room_id = '$room_id';");
            $update_room = exceData("UPDATE `tbl_room` SET `ro_id`='1' WHERE room_id = '$old_room_id';");
        }

        $new_user = getData("SELECT * FROM `tbl_user` where user_id = $user_id");
        $new_id_user = $new_user['0']['user_id'];
        $query = exceData("UPDATE `tbl_user` SET `room_id` = '$room_id', `stay_date` = '$move_in_date' WHERE `user_id` = '$new_id_user'");

        $old_user = exceData("UPDATE `tbl_user` SET `room_id` = NULL, `stay_date` = NULL WHERE `user_id` = '$user_id_old';");

        echo "<!DOCTYPE html>
        <html>
        <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'แก้ไขลงทะเบียนย้ายเข้าเรียบร้อย',
                text: 'เรียบร้อย',
            }).then(function() {
                window.location = 'register_user_room.php';
            });
        </script>
        </body>
        </html>";
    }

    
    // header('location:register_user_room.php');

?>
<?php
    session_start();
    include "connect.php";

    $room_id = mysqli_real_escape_string($conn, $_GET["room_name"]);
    $move_in_date = mysqli_real_escape_string($conn, $_GET["move_in_date"]);
    $user_id = mysqli_real_escape_string($conn, $_GET["tenant_name"]);

    $query = exceData("UPDATE `tbl_user` SET `room_id` = '$room_id', `stay_date` = '$move_in_date' WHERE `user_id` = '$user_id';");
    $query2 = exceData("UPDATE `tbl_room` SET `ro_id` = '2' WHERE `tbl_room`.`room_id` = '$room_id'");

    $log_room = exceData("INSERT INTO `log_room`(`room_id`, `user_id`, `start_date`, `end_date`) VALUES ('$room_id','$user_id','$move_in_date',NULL)");
    if($query){
        echo "<!DOCTYPE html>
        <html>
        <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'ลงทะเบียนย้ายเข้าเรียบร้อย',
                text: 'เรียบร้อย',
            }).then(function() {
                window.location = 'register_user_room.php';
            });
        </script>
        </body>
        </html>";
    } else {
        echo "<script>alert('An error occurred. Please try again later.');</script>";
    }
?>
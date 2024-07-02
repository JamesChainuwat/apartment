<?php
    session_start();
    include "connect.php";

    $bill_id = $_GET['id'];
    $user_id = $_GET['user_id'];
    $query = exceData("DELETE FROM tbl_room_bill WHERE `tbl_room_bill`.`bill_id` = $bill_id");

    if($query > 0){
        echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Delete success',
                    text: 'ลบข้อมูลเรียบร้อย',
                }).then(function() {
                    window.location = 'bill_user.php?id=$user_id';
                });
              </script>
              </body>
              </html>";
    }

    // header("location:bill_user.php?id=$user_id");
?>
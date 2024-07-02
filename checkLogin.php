<?php
    session_start();
    include "connect.php";

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $query = getData("SELECT * FROM `tbl_admin` WHERE ad_name = '$username' and ad_pass = '$pass'");
    $user = getData("SELECT * FROM `tbl_user` WHERE user_name = '$username' and user_pass = '$pass'");


    if (!empty($query)) {
        // ใช้ข้อมูลของแถวแรกในกรณีที่มีหลายแถวที่ตรงเงื่อนไข
        $data = $query[0];

        if($data['ad_status'] == 0){
            // echo '<script>alert("Username ของคุณถูกปิดการใช้งาน"); window.location.href = "login.php";</script>';
            echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Username ของคุณถูกปิดการใช้งาน',
                }).then(function() {
                    window.location = 'login.php';
                });
              </script>
              </body>
              </html>";
        }else{

        $_SESSION['start'] = true;
        $_SESSION['id'] = $data['admin_id'];
        $_SESSION['fname'] = $data['ad_fname'];
        $_SESSION['lname'] = $data['ad_lname'];
        // echo '<script>alert("admin");</script>';

        echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login success',
                    text: 'เข้าสู่ระบบสำเร็จ',
                }).then(function() {
                    window.location = 'index.php';
                });
              </script>
              </body>
              </html>";
            }

        // header("location:index.php");
    } else if(!empty($user)){

        $data = $user[0];
        if($data['u_status'] == 0){
            // echo '<script>alert("Username ของคุณถูกปิดการใช้งาน"); window.location.href = "login.php";</script>';
            echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Username ของคุณถูกปิดการใช้งาน',
                }).then(function() {
                    window.location = 'login.php';
                });
              </script>
              </body>
              </html>";
        }else{
        $_SESSION['start'] = true;
        $_SESSION['id'] = $data['user_id'];
        $_SESSION['fname'] = $data['fname'];
        $_SESSION['lname'] = $data['lname'];
        // echo '<script>alert("user");</script>';
        echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login success',
                    text: 'เข้าสู่ระบบสำเร็จ',
                }).then(function() {
                    window.location = 'users/index.php';
                });
              </script>
              </body>
              </html>";
            }
        // header("location:index_user.php");
    }else{
        // echo '<script>alert("Password หรือ Username ผิด"); window.location.href = "login.php";</script>';
        echo "<!DOCTYPE html>
              <html>
              <head>
              <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
              <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Username or Password',
                }).then(function() {
                    window.location = 'login.php';
                });
              </script>
              </body>
              </html>";
    }
?>
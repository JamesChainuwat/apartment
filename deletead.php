<?php
    include("connect.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM `tbl_admin` WHERE admin_id = '$id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $hide_status = $row["hide_status"];
    $ad_status = $row["ad_status"];

    if($hide_status == '0'){

        $hide_status = '1';
        $ad_status = '0';

    }else{

        $hide_status = '1';
    }

    $update = "UPDATE `tbl_admin` SET admin_id = $id,hide_status='$hide_status',ad_status='$ad_status' where admin_id = '$id' ";
    $result = mysqli_query($conn,$update);
    if(mysqli_query($conn,$sql)){
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
             window.location = 'admin.php';
         });
       </script>
       </body>
       </html>";
    }else{
        echo "ERROR : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
    }

mysqli_close($conn);

?>
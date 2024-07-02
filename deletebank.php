<?php
    include("connect.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM `tbl_bank` WHERE bank_id = '$id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $isActive = $row["isActive"];

    if($isActive == '1'){

        $isActive = '0';

    }else{

        $isActive = '1';
    }
    $update = "UPDATE `tbl_bank` SET isActive = '$isActive' where bank_id = '$id' ";
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
             window.location = 'bank.php';
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
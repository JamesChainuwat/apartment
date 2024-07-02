<?php
    include('connect.php');
    $admin_id = $_POST['admin_id'];
    $sql = "SELECT * FROM `tbl_admin` where admin_id = '$admin_id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $status = $row["ad_status"];

    if($status == '1'){

        $status = '0';

    }else{

        $status = '1';
    }

    $update = "UPDATE `tbl_admin` SET ad_status = '$status' where admin_id = '$admin_id' ";
    $result = mysqli_query($conn,$update);
    if($result){
                    echo $status;
                }
?>
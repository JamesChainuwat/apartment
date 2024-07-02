<?php
    include('connect.php');
    $user_id = $_POST['user_id'];
    $sql = "SELECT * FROM `tbl_user` where user_id = '$user_id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $status = $row["u_status"];

    if($status == '1'){

        $status = '0';

    }else{

        $status = '1';
    }

    $update = "UPDATE `tbl_user` SET u_status = '$status' where user_id = '$user_id' ";
    $result1 = mysqli_query($conn,$update);
    if($result1){
        echo $status;
    }
?>
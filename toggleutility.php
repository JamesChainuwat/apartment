<?php
    include('connect.php');
    $utility_id = $_POST['utility_id'];
    $sql = "SELECT * FROM `tbl_utility` where utility_id = '$utility_id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $status = $row["status"];

    if($status == '1'){

        $status = '0';

    }else{

        $status = '1';
    }
    
    $allStatus = exceData("UPDATE `tbl_utility` SET status = '0'");
    if($allStatus){
        $update = "UPDATE `tbl_utility` SET status = '$status' where utility_id = '$utility_id' ";
        $result1 = mysqli_query($conn,$update);
        if($result1){
            echo $status;
        }
    }
?>
<?php
    session_start();
    include "../connect.php";

    $bill_id = $_POST['bill_id'];
    $payment_date = $_POST['payment_date'];
    $type_pay = $_POST['type_pay'];
    $payment_amount = $_POST['payment_amount'];

    $rent_receipt = $_FILES['rent_receipt'];
    $tempNameadPicture = $rent_receipt['tmp_name'];

    $query_status = exceData("UPDATE `tbl_room_bill` SET `bill_status`='2' WHERE `tbl_room_bill`.`bill_id` = '$bill_id'");

    if(!empty($tempNameadPicture)){
        $imgadPicture = addslashes(file_get_contents($tempNameadPicture));

        $bill = getData("SELECT * FROM `tbl_pay_room` where bill_id = '$bill_id'") ?? '';
        if(!empty($bill['0'])){
            $bill_pay_id = $bill[0]['pay_id'] ?? '';
            $query = exceData("UPDATE `tbl_pay_room` SET `pay_amount`='$payment_amount',`pay_img`='$imgadPicture',`pay_date`='$payment_date',`type_pay`='$type_pay' WHERE tbl_pay_room.pay_id = '$bill_pay_id'");
        }else{
            $query = exceData("INSERT INTO `tbl_pay_room`(`pay_amount`, `pay_img`, `pay_date`, `type_pay`, `bill_id`) VALUES ('$payment_amount','$imgadPicture','$payment_date','$type_pay','$bill_id')");
        }
    }else{
        $bill = getData("SELECT * FROM `tbl_pay_room` where bill_id = '$bill_id'") ?? '';
        // var_dump($bill['0']);
        if(!empty($bill['0'])){
            $bill_pay_id = $bill[0]['pay_id'] ?? '';
            $query = exceData("UPDATE `tbl_pay_room` SET `pay_amount`='$payment_amount',`pay_img`='',`pay_date`='$payment_date',`type_pay`='$type_pay' WHERE `tbl_pay_room`.`pay_id` = '$bill_pay_id'");
        }else{
            $query = exceData("INSERT INTO `tbl_pay_room`(`pay_amount`, `pay_date`, `type_pay`, `bill_id`) VALUES ('$payment_amount','$payment_date','$type_pay','$bill_id')");
        }
    }
    
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
                  title: 'จ่ายเงินเรียบร้อย',
                  text: 'รอผู้ดูแลระบบยืนยันการจ่ายเงิน',
              }).then(function() {
                  window.location = 'waiting.php';
              });
            </script>
            </body>
            </html>";
    }else{
        echo "<script>alert('ไม่สามารถจ่ายเงินได้');</script>";
    }

?>
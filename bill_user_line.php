<?php
    session_start();
    include "connect.php";

    $user_id = $_GET['user_id'];
    $room_bill_id = $_GET['rbi'];

    $bill = getData("SELECT *,tbl_room.room_id ri,bill_water_now bwn FROM `tbl_user`
    INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
    INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
    LEFT JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_room.room_id AND tbl_room_bill.user_id = '$user_id'
    where tbl_user.user_id = '$user_id' and tbl_room_bill.bill_id = '$room_bill_id'
    -- ORDER BY room_bill.bill_date DESC LIMIT 1
    ");

    $bank = getData("SELECT * FROM `tbl_bank` WHERE isActive = 1");

    function sendLineNotify($message, $token) {
        $url = 'https://notify-api.line.me/api/notify';
        $data = array('message' => $message);
    
        $options = array(
            'http' => array(
                'header' => "Authorization: Bearer $token",
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
    
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    
        return $result;
    }

    $billId = $bill['0']['bill_id'];
    $roomName = $bill['0']['room_name'];
    $billWaterTotal = $bill['0']['bill_water_total'];
    $billElecTotal = $bill['0']['bill_elec_total'];
    $billServeTotal = $bill['0']['bill_serve_total'];
    $billPriceTotal = $bill['0']['bill_price_total'];
    $fname = $bill['0']['fname'];
    $lname = $bill['0']['lname'];

    $billDate = new DateTime($bill['0']['bill_date']);
    $thaiMonths = [
        'January' => 'มกราคม',
        'February' => 'กุมภาพันธ์',
        'March' => 'มีนาคม',
        'April' => 'เมษายน',
        'May' => 'พฤษภาคม',
        'June' => 'มิถุนายน',
        'July' => 'กรกฎาคม',
        'August' => 'สิงหาคม',
        'September' => 'กันยายน',
        'October' => 'ตุลาคม',
        'November' => 'พฤศจิกายน',
        'December' => 'ธันวาคม'
    ];
    $englishMonth = $billDate->format('F');
    $thaiMonth = $thaiMonths[$englishMonth];

    
    // ข้อความที่ต้องการส่ง
    $message = "\n รายละเอียดบิล\n\n";
    $message .= "เลขบิล: $billId\n";
    $message .= "รอบบิล: $thaiMonth\n\n";
    $message .= "คุณ: $fname $lname\n";
    $message .= "เลขห้อง: $roomName\n\n";
    $message .= "ค่าน้ำ: " . number_format($billWaterTotal) . " บาท\n";
    $message .= "ค่าไฟ: " . number_format($billElecTotal) . " บาท\n";
    $message .= "ค่าบริการ: " . number_format($billServeTotal) . " บาท\n\n";
    $message .= "รวมทั้งหมด: " . number_format($billPriceTotal) . " บาท\n\n";

    $message .= "จ่ายเงินได้ที่ \n\n";
    foreach ($bank as $key => $value) {
        if(count($bank) > 1){
            $message .= "ธนาคาร: " . $value['bank_name']."\n";
            $message .= "ชื่อบัญชี: " . $value['bank_acc']."\n";
            $message .= "เลขบัญชี: " . $value['bank_acc_no']."\nหรือ\n ";
        }else{
            $message .= "ธนาคาร: " . $value['bank_name']."\n";
            $message .= "ชื่อบัญชี: " . $value['bank_acc']."\n";
            $message .= "เลขบัญชี: " . $value['bank_acc_no']."\n ";
        }

    }
    // LINE Notify Token ที่ได้จากขั้นตอนที่ 2
    $lineNotifyToken = "tLBK4VYPD0cVWBfYhWX6Q2nMVfuT7ESKKUDXRjdLES8";
    
    // ส่ง LINE Notify
    $response = sendLineNotify($message, $lineNotifyToken);
    
    // ตรวจสอบการส่ง
    if ($response === FALSE) {
        echo 'Error sending LINE Notify';
    } else {
        echo 'LINE Notify sent successfully';
    }

    header("location:bill_user.php?id=$user_id");

?>
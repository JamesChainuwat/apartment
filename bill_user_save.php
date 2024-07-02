<?php
    session_start();
    include "connect.php";
    
    $user_id_rental = $_POST['user_id_rental'];

    $room_id = $_POST['room_id'];
    $services = $_POST['services'];

    $roomNumber = $_POST['roomNumber'];
    $date = $_POST['date'];
    $rentAmount = $_POST['rentAmount'];

    $waterMeterCurrent = $_POST['waterMeterCurrent'];
    $waterMeterPrevious = $_POST['waterMeterPrevious'];
    $waterTotal = $_POST['waterTotal'];

    $waterPicture = $_FILES['waterPicture'];
    $tempNameWaterPicture = $waterPicture['tmp_name'];
    $imgWaterPicture = addslashes(file_get_contents($tempNameWaterPicture));



    // $electricMeterCurrent = $_POST['electricMeterCurrent'];
    // $electricMeterPrevious = $_POST['electricMeterPrevious'];
    $electricTotal = $_POST['electricTotal'];

    $electricPicture = $_FILES['electricPicture'];
    $tempNameElectricPicture = $electricPicture['tmp_name'];
    $imgElectricPicture = addslashes(file_get_contents($tempNameElectricPicture));



    $totalAmount = $_POST['totalAmount'];


    $numberBill = getData("SELECT * FROM `tbl_room_bill`");

    $sumService = 0;
    foreach ($services as $key => $value) {
        $sumService += $value;
    }
    
    // $services_id = array_filter(array_keys($services), 'is_numeric');
    // $services_id_json = json_encode($services_id);


    $query = exceData("INSERT INTO `tbl_room_bill`(`bill_water_before`, `bill_water_now`, `bill_water_total`, `bill_water_img`, `bill_elec_total`, `bill_elec_img`, `bill_serve_total`, `bill_price_total`, `bill_date`, `user_id` , `bill_status`, `room_id`) 
    VALUES ('$waterMeterPrevious','$waterMeterCurrent','$waterTotal','$imgWaterPicture','$electricTotal','$imgElectricPicture','$sumService','$totalAmount','$date','$user_id_rental','0','$room_id')");

    header("location:bill_user.php?id=$user_id_rental");
?>
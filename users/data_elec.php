<?php
session_start();
include "../connect.php"; // Replace with your database connection script

$id = $_POST['id'];

$query  = getData("SELECT * FROM `tbl_room_bill` WHERE bill_id = '$id'");

if($query) {
    $bill_elec_img = base64_encode($query[0]['bill_elec_img']);
    if(!empty($query[0]['bill_elec_img'])){
        echo '<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รูปใบแจ้งค่าไฟ</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img src="data:image/jpeg;base64,'.$bill_elec_img.'" class="img-fluid" id="modalImage" />
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
      </div>';
    }else{
        echo '<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รูปใบแจ้งค่าไฟ</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>ยังไม่มีหลักฐานการจ่ายเงิน</h3>
            <div class="modal-footer">
            <button type="button" class="close" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
      </div>';
    }
    
}
?>
<?php
session_start();
include "connect.php"; // Replace with your database connection script

$id = $_POST['id'];

$query  = getData("SELECT *,tbl_room_bill.bill_id rbi FROM `tbl_user`
INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id
INNER JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_user.room_id
INNER JOIN tbl_pay_room on tbl_pay_room.bill_id = tbl_room_bill.bill_id
WHERE tbl_room_bill.bill_id = '$id'");

if($query) {
    $image = base64_encode($query[0]['pay_img']);
    if($query[0]['type_pay'] == "โอนเงินผ่านธนาคาร"){
        echo '<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">สลิปจ่ายค่าห้อง</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title">ประเภทการจ่ายเงิน :'. $query[0]['type_pay'] .'</h5>
                <img src="data:image/jpeg;base64,'.$image.'" class="img-fluid" id="modalImage" />
                
                <table class="table mt-3">
                    <tr>
                        <th>ค่าเช่า</th>
                        <th>ค่าน้ำรวม</th>
                        <th>ค่าไฟรวม</th>
                        <th>ค่าบริการ</th>
                        <th>รวมทั้งหมด</th>
                    </tr>
                    <tr>
                        <td>'.number_format($query[0]['roomtype_price'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_water_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_elec_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_serve_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_price_total'], 2).' บาท</td>
                    </tr>
                </table>
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
                <h5 class="modal-title">สลิปจ่ายค่าห้อง</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title">ประเภทการจ่ายเงิน :'. $query[0]['type_pay'] .'</h5>
                
                <table class="table mt-3">
                    <tr>
                        <th>ค่าเช่า</th>
                        <th>ค่าน้ำรวม</th>
                        <th>ค่าไฟรวม</th>
                        <th>ค่าบริการ</th>
                        <th>รวมทั้งหมด</th>
                    </tr>
                    <tr>
                        <td>'.number_format($query[0]['roomtype_price'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_water_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_elec_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_serve_total'], 2).' บาท</td>
                        <td>'.number_format($query[0]['bill_price_total'], 2).' บาท</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="close" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
      </div>';
    }
    
}else{
    echo '<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">สลิปจ่ายค่าห้อง</h5>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h1>ยังไม่มีหลักฐานการจ่ายเงิน</h1>
        </div>
        <div class="modal-footer">
            <button type="button" class="close" data-bs-dismiss="modal">ปิด</button>
        </div>
    </div>
  </div>';
}
?>
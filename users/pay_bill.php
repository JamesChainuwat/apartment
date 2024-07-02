<?php 
    session_start();
    include "../connect.php";
    if(empty($_SESSION['id'])){
        header("location:../login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- เรียกใช้ Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- เรียกใช้ Lightbox2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../menu/users/navbar_user.php'?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include '../menu/users/topbar_user.php'?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- ****start****  -->
                        <!-- <h2 class="mt-4 mb-4">รายงานค่าเช่า</h2>
                        <hr> -->
                        <!-- <div class="text-right mb-3">
                            <a href="?create=create" class="btn btn-success">เพิ่ม</a>
                        </div> -->
                        <div class="container-fluid mt-5">
                            <div class="card">
                                <div class="card-body">
                                    
                                <?php
                                            $bill_id = $_GET['id'];

                                            $query = getData("SELECT * FROM `tbl_room`
                                            INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
                                            INNER JOIN tbl_user on tbl_user.room_id = tbl_room.room_id
                                            INNER JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_room.room_id where tbl_room_bill.bill_id = '$bill_id'");

                                                $billDate = new DateTime($query['0']['bill_date']);
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
                                                $day = $billDate->format('d');
                                                $thaiMonth = $thaiMonths[$englishMonth];
                                        ?>


                                    <h3 class="text-center mt-4 mb-4">แบบฟอร์มส่งข้อมูลสลิปเงินค่าเช่าห้อง ประจำเดือน <?= $thaiMonth?></h3>

                                    <h4 class="text-center mt-4 mb-4">จ่ายเงินได้ที่</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ชื่อธนาคาร</th>
                                                <th>ชื่อบัญชี</th>
                                                <th>เลขบัญชี</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                    $bank = getData("SELECT * FROM `tbl_bank` WHERE isActive = 1");
                                                    foreach ($bank as $key => $value) {
                                                ?>
                                            <tr>
                                                <td><?= $value['bank_name']?></td>
                                                <td><?= $value['bank_acc']?></td>
                                                <td><?= $value['bank_acc_no']?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>

                                    <form action="payment.php" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="bill_id" value="<?= $bill_id?>">
                                        
                                        <div class="form-group">
                                            <label for="payment_date">วันที่จ่าย:</label>
                                            <input type="date" class="form-control" name="payment_date"
                                                id="payment_date"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_amount">จำนวนเงินที่จ่าย (บาท):</label>
                                            <input type="number" class="form-control" name="payment_amount"
                                                id="payment_amount" value="<?= $query['0']['bill_price_total'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="type_pay">ประเภทจ่ายเงิน:</label>
                                                <select name="type_pay" id="type_pay" class="form-control" required>
                                                    <option value="โอนเงินผ่านธนาคาร">โอนเงินผ่านธนาคาร</option>
                                                    <option value="เงินสด">เงินสด</option>
                                                </select>
                                        </div>
                                        <div class="form-group" id="rent_receipt_field" style="display:none;">
                                            <label for="rent_receipt">อัปโหลดสลิปเงินค่าเช่าห้อง:</label>
                                            <input type="file" class="form-control-file" name="rent_receipt"
                                                id="rent_receipt">
                                        </div>
                                        <div class="form-group" data-lightbox="rent_receipt_image" data-title="สลิปเงินค่าเช่าห้อง">
                                            <center>
                                                <img src="" id="preview_image" style="display:none; max-width: 500px; max-height: 500px;">
                                            </center>
                                        </div>
                                        <a href="index.php" class="btn btn-secondary mr-5">กลับ</a>
                                        <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ****End**** -->
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>


    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#report_payment").DataTable();
    });

    $(document).ready(function(){
            // เมื่อไฟล์รูปภาพถูกเลือก
            $('#rent_receipt').change(function(){
                var file = $(this)[0].files[0];
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#preview_image').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            });
        });

    $(document).ready(function(){
        const typePaySelect = document.getElementById('type_pay');
        const rentReceiptField = document.getElementById('rent_receipt_field');

        function toggleRentReceiptField() {
            rentReceiptField.style.display = typePaySelect.value === 'โอนเงินผ่านธนาคาร' ? 'block' : 'none';
        }

        typePaySelect.addEventListener('change', toggleRentReceiptField);

        toggleRentReceiptField(); // Run on initial load to set the correct state
    });
    </script>

</body>

</html>
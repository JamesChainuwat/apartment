<?php 
    session_start();
    include "connect.php";
    if(empty($_SESSION['id'])){
        header("location:login.php");
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'menu/navbar.php'?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'menu/topbar.php'?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div> -->



                    <div class="col-md-12">
                        <!-- ****start****  -->
                        <!-- <h2 class="mt-4 mb-4">รายงานค่าเช่า</h2>
                        <hr> -->
                        <!-- <div class="text-right mb-3">
                            <a href="?create=create" class="btn btn-success">เพิ่ม</a>
                        </div> -->
                        <div class="container mt-5">
                            <h2 class="text-center mb-4">รายงานค่าเช่า</h2>

                            <form action="report_payment_date.php" method="GET" class="mb-5">
                                <div class="form-group">
                                    <label for="move_in_date">เลือกเดือน</label>
                                    <input type="month" class="form-control" id="move_in_date" name="date" required>
                                    
                                    
                                </div>

                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                <a href="report_payment.php" class="btn btn-info">กลับ</a>
                            </form>

                            <h4 class="text-center mt-4 mb-4">ทั้งหมด</h4>
                            <table class="table table-bordered bg-white" id="report_payment">
                                <thead>
                                    <tr>
                                        <th>เลขห้องเช่า</th>
                                        <!-- <th>ประเภทห้อง</th> -->
                                        <!-- <th>ผู้เช่า</th> -->
                                        <th>รอบบิล</th>
                                        <th>สถานะ</th>
                                        <th>หลักฐาน</th>
                                        <th>จำนวนเงิน</th>
                                        <!-- <th>ลบ</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                    <?php
                                    $query = getData('SELECT DISTINCT * FROM `tbl_room`
                                    INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id
                                    INNER JOIN tbl_user ON tbl_user.room_id = tbl_room.room_id
                                    INNER JOIN tbl_room_bill ON tbl_room_bill.user_id = tbl_user.user_id');
                                    foreach($query as $i => $data){

                                        $billDate = new DateTime($data['bill_date']);
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
                                        $thaiDate = $billDate->format('j') . ' ' . $thaiMonth . ' ' . ($billDate->format('Y') + 543);
                                ?>

                                    <tr>
                                        <td><?= $data['room_name']?></td>

                                        <td><?= $thaiDate?></td>
                                        <td>

                                        <?php
                                                    if($data['bill_status'] == 0){
                                                    ?>
                                                        <span class="badge bg-danger text-white">ยังไม่ได้จ่าย</span>
                                                    <?php
                                                    }else if($data['bill_status'] == 1){
                                                    ?>
                                                        <span class="badge bg-success text-white">จ่ายแล้ว</span>
                                                    <?php
                                                    }else{
                                                ?>
                                                        <span class="badge bg-warning text-white">รอตรวจสอบ</span>
                                                <?php
                                                }
                                                ?>

                                        </td>
                                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" data-id="<?= $data['bill_id']?>">
                                        ดูหลักฐาน
                                        </button></td>
                                        <td>
                                            <?= number_format($data['bill_price_total'])?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                    <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                                </tbody>
                            </table>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <center>
                                        <h4 class="text-center mt-4 mb-4">สถานะจ่าย หรือ ไม่จ่าย</h4>
                                        <canvas id="pieChart" width="400" height="400"></canvas>
                                    </center>
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

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal">
        <div class="modal-dialog">
            <div class="modal-body">
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#report_payment").DataTable();
    });
    <?php
        $pay_success = getData('SELECT DISTINCT * FROM `tbl_room`
        INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id
        INNER JOIN tbl_user ON tbl_user.room_id = tbl_room.room_id
        INNER JOIN tbl_room_bill ON tbl_room_bill.user_id = tbl_user.user_id where tbl_room_bill.bill_status = 1');

        $not_success = getData('SELECT DISTINCT * FROM `tbl_room`
        INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id
        INNER JOIN tbl_user ON tbl_user.room_id = tbl_room.room_id
        INNER JOIN tbl_room_bill ON tbl_room_bill.user_id = tbl_user.user_id where tbl_room_bill.bill_status = 0');
    ?>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['จ่าย', 'ค้างจ่าย'], // Replace with your labels
            datasets: [{
                label: 'Payment Status',
                data: [<?= count($pay_success)?>, <?= count($not_success)?>], // Replace with your data
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false
        }
    });

    $(document).ready(function(){
        $("#paymentModal").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                type: "POST",
                url: "report_payment_bill_slip.php",
                data: { id: id },
                success: function(data){
                    $(".modal-body").html(data);
                }
            });
        });
    });
    </script>

</body>

</html>
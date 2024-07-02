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
                    <div class="col-md-12">
                        <!-- ****start****  -->
                        <!-- <h2 class="mt-4 mb-4">รายงานค่าเช่า</h2>
                        <hr> -->
                        <!-- <div class="text-right mb-3">
                            <a href="?create=create" class="btn btn-success">เพิ่ม</a>
                        </div> -->
                        <div class="container-fluid mt-5">

                            <h4 class="text-center mt-4 mb-4">Dashboard</h4>
                            <table class="table table-bordered bg-white" id="report_payment">
                                <thead>
                                    <tr>
                                        <th>เลขห้องเช่า</th>
                                        <th>ประเภทห้อง</th>
                                        <th>ผู้เช่า</th>
                                        <th>รอบบิล</th>
                                        <th>สถานะ</th>
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
                                    INNER JOIN tbl_room_bill ON tbl_room_bill.user_id = tbl_user.user_id
                                    ');
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
                                    foreach($query as $i => $value){

                                        $billDate = new DateTime($value['bill_date']);
                                        
                                        $englishMonth = $billDate->format('F');
                                        $thaiMonth = $thaiMonths[$englishMonth];
                                ?>

                                    <tr>
                                        <td><?= $value['room_name']?></td>
                                        <td><?= $value['roomtype_name']?></td>
                                        <td><?=$value['fname']?> <?= $value['lname'] ?></td>
                                        <td><?= $thaiMonth?></td>
                                        <td>
                                        <?php
                                                    if($value['bill_status'] == 0){
                                                    ?>
                                                        <span class="badge bg-danger text-white">ยังไม่ได้จ่าย</span>
                                                    <?php
                                                    }else if($value['bill_status'] == 1){
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
                                        <td>
                                            <?= number_format($value['bill_price_total'])?>
                                        </td>
                                        <!-- <td>
                                        <a href="?delete=<?= $value['user_id']?>" type="button"
                                            class="btn btn-danger">ลบ</a>
                                    </td> -->
                                    </tr>
                                    <?php
                                    }
                                ?>
                                    <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                                </tbody>
                            </table>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <center>
                                        <h4 class="text-center mt-4 mb-4">สถานะจ่าย หรือ ไม่จ่าย</h4>
                                        <canvas id="pieChart" width="400" height="400"></canvas>
                                    </center>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <h4 class="text-center mt-4 mb-4">ยอดรวมบิลรายเดือน</h4>
                                        <canvas id="billChart"></canvas>
                                    </center>
                                </div>
                                <!-- <div class="col-md-6"></div> -->
                                <div class="col-md-12">
                                    <center>
                                        <h4 class="text-center mt-4 mb-4">ยอดรวมบิลรายเดือน</h4>
                                        <table class="table table-bordered bg-white" id="report_monthYear">
                                <thead>
                                    <tr>
                                        <th>เดือน</th>
                                        <th>ปี</th>
                                        <th>รวมทั้งหมด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT SUM(bill_price_total) AS total, YEAR(bill_date) AS year, MONTH(bill_date) AS month FROM tbl_room_bill GROUP BY YEAR(bill_date), MONTH(bill_date)";
                                    $datas = getData($sql);

                                    $thai_months = [
                                        1 => 'มกราคม',
                                        2 => 'กุมภาพันธ์',
                                        3 => 'มีนาคม',
                                        4 => 'เมษายน',
                                        5 => 'พฤษภาคม',
                                        6 => 'มิถุนายน',
                                        7 => 'กรกฎาคม',
                                        8 => 'สิงหาคม',
                                        9 => 'กันยายน',
                                        10 => 'ตุลาคม',
                                        11 => 'พฤศจิกายน',
                                        12 => 'ธันวาคม',
                                    ];
                                    
                                foreach($datas as $i => $data){
                                    ?>
                                    <tr>
                                        <td><?= $thai_months[$data["month"]]?></td>
                                        <td><?= $data['year']+543?></td>
                                        <td><?= number_format($data['total'],2)?> บาท</td>

                                    </tr>
                                <?php }?>
                                </tbody>
                                        </table>
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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        $("#report_monthYear").DataTable();
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

        $sql = "SELECT SUM(bill_price_total) AS total, YEAR(bill_date) AS year, MONTH(bill_date) AS month FROM tbl_room_bill where bill_status = 1 GROUP BY YEAR(bill_date), MONTH(bill_date)";
        $data = getData($sql);
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

    const thaiMonths = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
        'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ];

    var billData = <?php echo json_encode($data); ?>;

    console.log(billData[0]);

    billData.forEach(item => {
        item.monthName = thaiMonths[item.month - 1];
    });

    var ctx = document.getElementById('billChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: billData.map(item => item.year + ' ' + item.monthName),
            datasets: [{
                label: 'ราคารวมของบิล',
                data: billData.map(item => item.total),
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16 // Adjust font size here
                        }
                    }
                }
            }
        }
    });

    // Render pie chart
    // var ctxPie = document.getElementById('pieChart').getContext('2d');
    // var myPieChart = new Chart(ctxPie, {
    //     type: 'pie',
    //     data: pieChartData
    // });
    </script>

</body>

</html>
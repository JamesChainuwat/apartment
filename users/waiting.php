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
                        <div class="container-fluid mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center mt-5 mb-4">ค่าเช่ารอการยืนยัน</h4>
                                    <table class="table table-bordered bg-white" id="waiting">
                                        <thead>
                                            <tr>
                                                <th>รอบบิล</th>
                                                <th>เลขห้องเช่า</th>
                                                <th>ประเภทห้อง</th>
                                                <th>สถานะ</th>
                                                <th>จำนวนเงิน</th>
                                                <th>ชำระเงิน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                            <?php
                                            $user_id = $_SESSION['id'];
                                    $query = getData("SELECT * FROM `tbl_room`
                                    INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
                                    INNER JOIN tbl_user on tbl_user.room_id = tbl_room.room_id
                                    INNER JOIN tbl_room_bill ON tbl_room_bill.user_id = tbl_user.user_id where tbl_room_bill.bill_status = '2' AND tbl_user.user_id = '$user_id'");
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
                                                <td>
                                                    <h4><?= $thaiDate?></h4>
                                                </td>
                                                <td><?= $data['room_name']?></td>
                                                <td><?= $data['roomtype_name']?></td>

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
                                                <td>
                                                    <?= number_format($data['bill_price_total'])?> บาท
                                                </td>
                                                <td>



                                                    <?php
                                            if($data['bill_status'] == 0){
                                            ?>
                                                    <a href="?delete=<?= $data['user_id']?>" type="button"
                                                        class="btn btn-danger">ชำระเงิน</a>
                                                    <?php
                                            }else if($data['bill_status'] == 1){
                                        ?>
                                                    <button type="button" class="btn btn-success" disabled>จ่ายแล้ว
                                                        </abutton>
                                                        <?php
                                            }else{
                                        ?>
                                                        <button type="button" class="btn btn-warning"
                                                            disabled>รอตรวจสอบ</button>
                                                        <?php
                                        }
                                        ?>

                                                </td>
                                            </tr>
                                            <?php
                                    }
                                ?>
                                            <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                                        </tbody>
                                    </table>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
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
        $("#waiting").DataTable();
    });
    </script>

</body>

</html>
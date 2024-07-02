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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "GET"){
                            if(isset($_GET['create'])){
                        ?>

                        <h2 class="mt-4 mb-4">เพิ่มข้อมูลลงทะเบียนเช่าห้อง</h2>

                        <!-- แบบฟอร์มเพิ่มข้อมูล -->
                        <form action="register_user_room_create.php" method="post">
                            <div class="form-group">
                                <label for="room_name">ชื่อห้องเช่า:</label>

                                <select class="form-control" id="room_name" name="room_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM `tbl_room`
                                    WHERE tbl_room.ro_id = 1');
                                    foreach($query as $i => $data){
                                ?>
                                    <option value="<?= $data['room_id']?>"><?= $data['room_name']?></option>
                                    <?php }?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="tenant_name">ชื่อจริง นามสกุล ผู้เช่า:</label>
                                <select class="form-control" id="tenant_name" name="tenant_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM `tbl_user` WHERE room_id IS NULL');
                                    foreach($query as $i => $data){
                                ?>
                                    <option value="<?= $data['user_id']?>"><?= $data['fname']?> <?= $data['lname']?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="move_in_date">วันที่เข้าพัก:</label>
                                <input type="date" class="form-control" id="move_in_date" name="move_in_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <a href="register_user_room.php" class="btn btn-info">กลับ</a>
                        </form>

                        <?php
                            } else if(isset($_GET['edit'])){
                                $ids = $_GET['edit'];
                                $querys = getData("SELECT * FROM `tbl_user` WHERE user_id = '$ids'");
                                foreach($querys as $i => $datas){
                        ?>
                        <h2 class="mt-4 mb-4">แก้ไขข้อมูลลงทะเบียนเช่าห้อง</h2>
                        <form action="register_user_room_edit.php" method="post">
                            <input type="hidden" name="user_id_old" value="<?= $datas['user_id']?>">
                            <div class="form-group">
                                <label for="room_name">ชื่อห้องเช่า:</label>

                                <select class="form-control" id="room_name" name="room_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM tbl_room');
                                    foreach($query as $i => $data){

                                        if($datas['room_id'] == $data['room_id']){
                                            ?>
                                    <option value="<?= $data['room_id']?>" selected><?= $data['room_name']?></option>
                                    <?php
                                        }else{
                                ?>
                                    <option value="<?= $data['room_id']?>"><?= $data['room_name']?></option>
                                    <?php }}?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="tenant_name">ชื่อจริง นามสกุล ผู้เช่า:</label>
                                <select class="form-control" id="tenant_name" name="tenant_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM tbl_user');
                                    foreach($query as $i => $data){

                                        if($datas['user_id'] == $data['user_id']){
                                            ?>
                                    <option value="<?= $data['user_id']?>" selected><?= $data['fname']?>
                                        <?= $data['lname']?></option>
                                    <?php
                                        }else{
                                    ?>
                                    <option value="<?= $data['user_id']?>"><?= $data['fname']?> <?= $data['lname']?>
                                    </option>
                                    <?php }}?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="move_in_date">วันที่เข้าพัก:</label>
                                <input type="date" class="form-control" id="move_in_date" name="move_in_date"
                                    value="<?=$datas['stay_date']?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <a href="register_user_room.php" class="btn btn-info">กลับ</a>
                        </form>


                        <?php
                            }
                            } else if(isset($_GET['delete'])){
                                // echo '<script>alert("delete");</script>';
                                ?>


                        <h1>delete</h1>

                        <?php
                            }
                        }
                    ?>
                        <h2 class="mt-4 mb-4">คิดค่าเช่าห้อง</h2>
                        <hr>
                        <table class="table table-bordered bg-white" id="bill">
                            <thead>
                                <tr>
                                    <th>ชื่อห้องเช่า</th>
                                    <th>ชื่อผู้เช่าห้อง</th>
                                    <th>วันที่เข้าพัก</th>
                                    <th>คำนวณค่าเช่า</th>
                                    <!-- <th>ลบ</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                <?php
                                    $query = getData("SELECT * FROM `tbl_user` INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id WHERE tbl_user.end_date IS NULL");
                                    foreach($query as $i => $data){
                                ?>

                                <tr>
                                    <td><?= $data['room_name']?></td>
                                    <td><?= $data['fname']?> <?= $data['lname']?></td>
                                    <td><?= $data['stay_date']?></td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-warning">แก้ไข</button> -->
                                        <a href="bill_user.php?id=<?= $data['user_id']?>" type="button"
                                            class="btn btn-warning">คำนวณค่าเช่า</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                            </tbody>
                        </table>
                        <!-- ****End**** -->
                        <hr>
                        <?php
                        $query = getData("SELECT *,tbl_room_bill.bill_id rbi FROM `tbl_user`
                        INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
                        INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id
                        INNER JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_user.room_id
                        INNER JOIN tbl_pay_room on tbl_pay_room.bill_id = tbl_room_bill.bill_id
                        WHERE tbl_room_bill.bill_status = 2 and tbl_user.u_status = 1");
                        ?>
                        <h2 class="mt-4 mb-4">ตรวจสอบคนจ่ายเงิน <span class="text-danger">(<?= count($query)?>)</span> </h2>
                        <table class="table table-bordered bg-white" id="bill">
                            <thead>
                                <tr>
                                    <th>เลขบิล</th>
                                    <th>เลขบิล</th>

                                    <th>รอบบิล</th>
                                    <th>ค่าเช่า</th>
                                    <th>ค่าน้ำรวม</th>
                                    <th>ค่าไฟรวม</th>
                                    <th>ค่าบริการ</th>
                                    <th>รวมทั้งหมด</th>
                                    <th>สถานะ</th>
                                    <th>ดูหลักฐาน</th>
                                    <!-- <th>ลบ</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                <?php
                                    
                                    foreach($query as $i => $data){
                                ?>

                                <tr>
                                    <td><?= $data['bill_id']?></td>
                                    <td><?= $data['room_name']?></td>
                                    <td><?= $data['bill_date']?></td>
                                    <td><?= number_format($data['roomtype_price'],2)?></td>
                                    <td><?= number_format($data['bill_water_total'],2)?></td>
                                    <td><?= number_format($data['bill_elec_total'],2)?></td>
                                    <td><?= number_format($data['bill_serve_total'],2)?></td>
                                    <td><?= number_format($data['bill_price_total'],2)?></td>
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
                                        <!-- <a href="bill_user.php?id=" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#paymentModal">ตรวจสอบสลิป</a> -->
                                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">ตรวจสอบสลิป</button> -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" data-id="<?= $data['bill_id']?>">
                                        ตรวจสอบสลิป
                                        </button>
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
    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div> -->


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
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
    $(document).ready(function() {
        $("#bill").DataTable();
    });
    
    $(document).ready(function(){
        $("#paymentModal").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                type: "POST",
                url: "bill_slip.php",
                data: { id: id },
                success: function(data){
                    $(".modal-body").html(data);
                }
            });
        });

        $(document).on('click', '#confirmButton', function(){
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "bill_slip_confirm.php",
                data: { id: id },
                success: function(response){
                    if(response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'ยืนยันสลิป สำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#paymentModal').modal('hide'); // Close the modal
                                // Optional: Redirect or refresh the page
                                window.location = 'bill.php';
                            }
                        });
                    } else {
                        // Handle failure
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an issue with the operation.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        $(document).on('click', '#notConfirmButton', function(){
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "bill_slip_not_confirm.php",
                data: { id: id },
                success: function(response){
                    if(response.success) {
                        Swal.fire({
                            title: 'ยกเลิกสำเร็จ',
                            text: 'ทำการส่งไปให้ ผู้ใช้ส่งบิลใหม่',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#paymentModal').modal('hide'); // Close the modal
                                // Optional: Redirect or refresh the page
                                window.location = 'bill.php';
                            }
                        });
                    } else {
                        // Handle failure
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an issue with the operation.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
    </script>

</body>

</html>
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
                                    INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
                                    WHERE tbl_room.ro_id = 1 AND tbl_room.hide_status = 0');
                                    foreach($query as $i => $data){
                                ?>
                                    <option value="<?= $data['room_id']?>"><?= $data['room_name']?> <?= $data['roomtype_name']?></option>
                                    <?php }?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="tenant_name">ชื่อจริง นามสกุล ผู้เช่า:</label>
                                <select class="form-control" id="tenant_name" name="tenant_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM `tbl_user` WHERE room_id IS NULL AND hide_status = 0');
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
                                $querys = getData("SELECT * FROM `tbl_user` inner join tbl_room on tbl_room.room_id = tbl_user.room_id WHERE user_id = '$ids'");
                                foreach($querys as $i => $datas){
                        ?>
                        <h2 class="mt-4 mb-4">แก้ไขข้อมูลลงทะเบียนเช่าห้อง</h2>
                        <form action="register_user_room_edit.php" method="post">
                            <input type="hidden" name="user_id_old" value="<?= $datas['user_id']?>">
                            <div class="form-group">
                                <label for="room_name">ชื่อห้องเช่า:</label>

                                <select class="form-control" id="room_name" name="room_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM tbl_room where ro_id = 1 AND hide_status = 0');
                                    foreach($query as $i => $data){
                                        if($datas['room_id'] == $data['room_id']){
                                 ?>
                                    <option value="<?= $datas['room_id']?>" selected><?= $datas['room_name']?></option>
                                        <?php }else{?>
                                    <option value="<?= $data['room_id']?>"><?= $data['room_name']?></option>
                                    <?php }}?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="tenant_name">ชื่อจริง นามสกุล ผู้เช่า:</label>
                                <select class="form-control" id="tenant_name" name="tenant_name" required>
                                    <?php
                                    $query = getData('SELECT * FROM tbl_user where hide_status = 0');
                                    foreach($query as $i => $data){

                                        if($datas['user_id'] == $data['user_id']){
                                            ?>
                                            <option value="<?= $data['user_id']?>" selected><?= $data['fname']?> <?= $data['lname']?></option>
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
                                <input type="date" class="form-control" id="move_in_date" name="move_in_date" value="<?=$datas['stay_date']?>" required>
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
                        <h2 class="mt-4 mb-4">ตารางลงทะเบียนเช่าห้อง (ย้ายเข้า)</h2>
                        <hr>
                        <div class="text-right mb-3">
                            <a href="?create=create" class="btn btn-success">เพิ่ม</a>

                        </div>
                        <table class="table table-bordered bg-white" id="register_user_room">
                            <thead>
                                <tr>
                                    <th>ชื่อห้องเช่า</th>
                                    <th>ประเภทห้องเช่า</th>
                                    <th>วันที่เข้าพัก</th>
                                    <th>ชื่อจริง นามสกุล ผู้เช่า</th>
                                    <th>แก้ไข</th>
                                    <!-- <th>ลบ</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                <?php
                                    $query = getData('SELECT * FROM `tbl_user`
                                    inner JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
                                    INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id WHERE end_date IS NULL;');
                                    foreach($query as $i => $data){
                                ?>

                                <tr>
                                    <td><?= $data['room_name']?></td>
                                    <td><?= $data['roomtype_name']?></td>
                                    <td><?= $data['stay_date']?></td>
                                    <td><?= $data['fname']?> <?= $data['lname']?></td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-warning">แก้ไข</button> -->
                                        <a href="?edit=<?= $data['user_id']?>" type="button"
                                            class="btn btn-warning">แก้ไข</a>
                                    </td>
                                    <!-- <td>
                                        <a href="?delete=<?= $data['user_id']?>" type="button"
                                            class="btn btn-danger">ลบ</a>
                                    </td> -->
                                </tr>
                                <?php
                                    }
                                ?>
                                <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                            </tbody>
                        </table>
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
            $(document).ready(function () {
                $("#register_user_room").DataTable();
            });
        </script>

</body>

</html>
<?php 
    session_start();
    include "../connect.php";

    if(empty($_SESSION['id'])){
        header("location:../login.php");
    }

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `tbl_user` WHERE user_id = '$id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

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
                                    <!-- ทำในนี้ๆ -->
                                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><?php echo '<img src="data:image/jpeg;base64, '.base64_encode($row['user_img'] ).'" class="rounded-circle mt-5" height="150px"width="150px"' ?></div>
                            <a href="edit_user.php?id=<?=$row["user_id"]?>" class="btn btn-success mt-3">แก้ไข</a></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-4">
                            <h2 class="text-center align-items-center">ข้อมูลโปรไฟล์</h2>
                            
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">ชื่อ</label><input type="text" class="form-control" value="<?php echo $row['fname'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">นามสกุล</label><input type="text" class="form-control" value="<?php echo $row['lname'] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">เลขบัตรประชาชน</label><input type="text" class="form-control" value="<?php echo $row['id_card'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">ตำบล</label><input type="text" class="form-control" value="<?php echo $row['subdistrict'] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">อำเภอ</label><input type="text" class="form-control" value="<?php echo $row['district'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">จังหวัด</label><input type="text" class="form-control" value="<?php echo $row['province'] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">รหัสไปรษณีย์</label><input type="text" class="form-control" value="<?php echo $row['zip_code'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">เบอร์โทร</label><input type="text" class="form-control" value="<?php echo $row['tel'] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">ไลน์</label><input type="text" class="form-control" value="<?php echo $row['line_id'] ?>" readonly></div>
                                </div>
                                <div class="mt-5 text-center"><a class="btn btn-danger" href="index.php" role="button">กลับหน้าแรก</a></div>
                            </div>
                        </div>
                                    <!-- ทำในนี้ๆ -->
                                    </div>
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
        $("#overdue").DataTable();
    });
    </script>

</body>

</html>
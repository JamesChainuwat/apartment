<?php
    include('connect.php');
    session_start();
    if(empty($_SESSION['id'])){
        header("location:login.php");
    }
    
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `tbl_admin` WHERE admin_id = '$id' ";
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

    <title>เพิ่มข้อมูล</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><?php echo '<img src="data:image/jpeg;base64, '.base64_encode($row['ad_img'] ).'" class="rounded-circle mt-5" height="150px"width="150px"' ?>                         
                        </div>
                        <a href="editadmin.php?id=<?=$row["admin_id"]?>" class="btn btn-success mt-3">แก้ไข</a></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-4">
                            <h2 class="text-center align-items-center">ข้อมูลโปรไฟล์</h2>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">ชื่อ</label><input type="text" class="form-control" value="<?php echo $row['ad_fname'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">นามสกุล</label><input type="text" class="form-control" value="<?php echo $row['ad_lname'] ?>" readonly></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">เบอร์โทร</label><input type="text" class="form-control" placeholder="first name" value="<?php echo $row['ad_tel'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">ไลน์</label><input type="text" class="form-control" value="<?php echo $row['ad_line'] ?>" readonly></div>
                                </div>
                                <div class="mt-5 text-center"><a class="btn btn-danger" href="index.php" role="button">กลับหน้าแรก</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
            <!-- ****End**** -->
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



    </div>

    </div>



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

</body>

</html>
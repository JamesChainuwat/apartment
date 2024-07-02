<?php 
    include('connect.php');
    session_start();

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

    <title>ข้อมูลเจ้าของหอพัก</title>

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

                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `tbl_admin` where admin_id='$id'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result);
    
                    ?>      

                <!-- Begin Page Content -->
                <div class="container">
                <div class="container d-flex justify-content-center">
                        <form action="" method="POST" enctype="multipart/form-data">
                        <h1 class="h3 mb-2 text-gray-800">ข้อมูลเจ้าของหอพัก/ผู้ดูแลระบบ</h1>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" name="ad_fname"  readonly
                                        value="<?php echo $row['ad_name'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>รหัสผ่าน</label>
                                    <input type="text" class="form-control" name="ad_lname" readonly
                                        value="<?php echo $row['ad_pass'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ</label>
                                    <input type="text" class="form-control" name="ad_fname"  readonly
                                        value="<?php echo $row['ad_fname'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>นามสกุล</label>
                                    <input type="text" class="form-control" name="ad_lname" readonly 
                                        value="<?php echo $row['ad_lname'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>เบอร์โทร</label>
                                    <input type="text" class="form-control" name="ad_tel" readonly
                                    value="<?php echo $row['ad_tel'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>LINE</label>
                                    <input type="text" class="form-control" name="ad_line" readonly
                                    value="<?php echo $row['ad_line'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <?php echo '<img src="data:image/jpeg;base64, '.base64_encode($row['ad_img'] ).'" height="100" width="100"' ?>
                            </div>
                                <div class="form-group">
                                    <label >สถานะ</label>
                                    <input readonly type="text" class="form-control" name="ad_status" value="<?php echo $row['ad_status']  ?>">
                                </div>
                                <a class="btn btn-danger" href="admin.php" role="button">กลับ</a>
                            </form>
                        </div>
                    </div>
                    </div>

                        <!-- ****End**** -->
                        
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

    <body>
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
        $("#admin").DataTable();
    });
    
</script>

    </body>
</html>
<?php
    include('connect.php');
    session_start();

    if(empty($_SESSION['id'])){
        header("location:login.php");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_room_type` where type_id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['edit'])){
        $roomtype_name = $_POST['roomtype_name'];
        $roomtype_detail = $_POST['roomtype_detail'];
        $roomtype_price = $_POST['roomtype_price'];

        $sql="UPDATE `tbl_room_type` set type_id=$id,roomtype_name='$roomtype_name',roomtype_detail='$roomtype_detail'
        ,roomtype_price='$roomtype_price' WHERE type_id = '$id' ";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "<!DOCTYPE html>
            <html>
            <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
            <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Edit Success',
                  text: 'แก้ไขข้อมูลเรียบร้อย',
              }).then(function() {
                  window.location = 'roomtype.php';
              });
            </script>
            </body>
            </html>";
        }else{
            echo "ERROR : " . $sql . "<br>" . mysqli_error($conn);
            echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
        }
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

    <title>แก้ไขข้อมูล</title>

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
                <div class="container">
                    <div class="text-center mb-4">
                        <h3>แก้ไขข้อมูล</h3>

                    </div>
                    <div class="container d-flex justify-content-center">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>ชื่อประเภทห้องเช่า</label>
                                <input type="text" class="form-control" name="roomtype_name"
                                    value="<?php echo $row['roomtype_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label>รายละเอียดห้องเช่า</label>
                                <input type="text" class="form-control" name="roomtype_detail"
                                    value="<?php echo $row['roomtype_detail'] ?>">
                            </div>
                            <div class="form-group">
                                <label>ราคาห้องเช่า</label>
                                <input type="text" class="form-control" name="roomtype_price"
                                    value="<?php echo $row['roomtype_price'] ?>">
                            </div>
                            <button type="submit" name="edit" class="btn btn-success">ยืนยัน</button>
                            <a class="btn btn-danger" href="roomtype.php" role="button">กลับ</a>
                    </div>
                    </form>
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

    </body>

</html>
<?php
    session_start();
    include "../connect.php";
    if(empty($_SESSION['id'])){
        header("location:../login.php");
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_user` where user_id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['edit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $tel = $_POST['tel'];

        $user_img = $_FILES['user_img']; 
        $tempNameuserPicture = $user_img['tmp_name'];

        if( !empty($tempNameuserPicture) ){
        $imguserPicture = addslashes(file_get_contents($tempNameuserPicture));
        $sql="UPDATE `tbl_user` set user_id=$id,fname='$fname',lname='$lname',tel='$tel',user_img='$imguserPicture' WHERE user_id = '$id' ";
        }else{
        $sql="UPDATE `tbl_user` set user_id=$id,fname='$fname',lname='$lname',tel='$tel' WHERE user_id = '$id' ";
        }
        $result=mysqli_query($conn,$sql);
        if($result){
            if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
                // ลบ $_SESSION['fname'] และ $_SESSION['lname']
                unset($_SESSION['fname'], $_SESSION['lname']);
            
                // กำหนดค่าใหม่ให้กับ $_SESSION['fname'] และ $_SESSION['lname']
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
            }

            echo "<!DOCTYPE html>
            <html>
            <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Edit success',
                    text: 'แก้ไขข้อมูลเรียบร้อย',
                }).then(function() {
                    window.location = 'profile_user.php';
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
                <div class="container">
                    <div class="text-center mb-4">
                        <h3>แก้ไขข้อมูล</h3>

                    </div>
                    <div class="container d-flex justify-content-center">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ</label>
                                    <input type="text" class="form-control" name="fname"
                                        value="<?php echo $row['fname'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>นามสกุล</label>
                                    <input type="text" class="form-control" name="lname"
                                        value="<?php echo $row['lname'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="tel"
                                    value="<?php echo $row['tel'] ?>">
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input type="file" class="form-control-file" name="user_img">
                            </div>
                            <button type="submit" name="edit" class="btn btn-success">ยืนยัน</button>
                            <a class="btn btn-danger" href="profile_user.php" role="button">กลับ</a>
                        </form>
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
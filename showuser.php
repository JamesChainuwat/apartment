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

    <title>ข้อมูลผู้เช่า</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
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
                    $sql = "SELECT * FROM `tbl_user` where user_id='$id'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result);
    
                    ?>      

                <!-- Begin Page Content -->
                <div class="container">
                <div class="container d-flex justify-content-center">
                        <form action="" method="POST" enctype="multipart/form-data">
                        <h1 class="h3 mb-2 text-gray-800">ข้อมูลผู้เช่า</h1>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" name="user_name" readonly
                                    value="<?php echo $row['user_name'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>รหัสผ่าน</label>
                                    <input type="text" class="form-control" name="user_pass"  readonly
                                    value="<?php echo $row['user_pass'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ</label>
                                    <input type="text" class="form-control" name="fname" readonly
                                    value="<?php echo $row['fname'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>นามสกุล</label>
                                    <input type="text" class="form-control" name="lname"  readonly
                                    value="<?php echo $row['lname'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>เลขบัตรประชาชน</label>
                                <input type="text" class="form-control" name="id_card" readonly
                                value="<?php echo $row['id_card'] ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ตำบล</label>
                                    <input type="text" class="form-control" name="subdistrict"readonly
                                    value="<?php echo $row['subdistrict'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>อำเภอ</label>
                                    <input type="text" class="form-control" name="district"readonly
                                    value="<?php echo $row['district'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>จังหวัด</label>
                                    <input type="text" class="form-control" name="province" readonly
                                    value="<?php echo $row['province'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" name="zip_code"readonly
                                    value="<?php echo $row['zip_code'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>เบอร์โทร</label>
                                    <input type="text" class="form-control" name="tel" readonly
                                    value="<?php echo $row['tel'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ไลน์</label>
                                    <input type="text" class="form-control" name="line_id" readonly
                                    value="<?php echo $row['line_id'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>หน่วยค่าน้ำแรกเข้า</label>
                                <input type="text" class="form-control" name="first_water_unit" readonly
                                    value="<?php echo $row['first_water_unit'] ?>">
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <?php echo '<img src="data:image/jpeg;base64, '.base64_encode($row['user_img'] ).'" height="100" width="100"' ?>">                                
                            </div>              
                            <a class="btn btn-danger" href="user.php" role="button">กลับ</a>                             
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <script>
            function confirmDeletion(id) {
                Swal.fire({
                    title: 'คุณแน่ใจไหม?',
                        text: "ยืนยันเพื่อดำเนินการลบต่อ",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ลบ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed the deletion
                        window.location.href = `deleteuser.php?id=${id}`
                    }
                });
            }
        </script>

<script>
    $(document).ready(function () {
        $("#user").DataTable();
    });

    function toggleStatus(id){
    var id = id;
    $.ajax({
        url:"toggle1.php",
        type:"post",
        data:{user_id:id},
        success :function(result){
            if(result == '1'){
                swal("เรียบร้อย!","เปลี่ยนสถานะเป็นใช้งาน","Success");
            }else{
                swal("เรียบร้อย!","เปลี่ยนสถานะเป็นไม่ได้เใช้งาน","Success");
            }
        }
    });
}
    
</script>

    </body>
</html>
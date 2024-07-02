<?php 
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
                    <h1 class="h3 mb-2 text-gray-800">รายการประเภทห้องเช่า</h1>
                    <a href="addroomtype.php" button type="button" class="btn btn-success">เพิ่มข้อมูล</button></a>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-2">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">ข้อมูลประเภทห้องเช่า</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="roomtype" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">ไอดี</th>
                                            <th class="text-center">ชื่อประเภทห้องเช่า</th>
                                            <th class="text-center">รายละเอียดห้องเช่า</th>
                                            <th class="text-center">ราคา</th>
                                            <th class="text-center">แก้ไข</th>
                                            <th class="text-center">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php                                        
                                        include('connect.php');

                                        $sql = "SELECT * FROM `tbl_room_type` WHERE hide_status = '0'";
                                        $result = mysqli_query($conn,$sql);
                                        $type_id = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $type_id ?></td>
                                            <td><?php echo $row['roomtype_name'] ?></td>
                                            <td><?php echo $row['roomtype_detail'] ?></td>
                                            <td><?php echo $row['roomtype_price'] ?></td>
                                            <td style="text-align:center"><a
                                                    href="editroomtype.php?id=<?=$row["type_id"]?>"><button
                                                        type="button" class="btn btn-warning">แก้ไข</button></a></td>
                                            <td style="text-align:center"> <a href="javascript:void(0);"
                                                    onclick="confirmDeletion('<?= $row['type_id'] ?>')" type="button"
                                                    class="btn btn-danger">ลบ</a></td>
                                        </tr>
                                        <?php
                                        $type_id++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
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
                    window.location.href = `deleteroomtype.php?id=${id}`
                }
            });
        }
        </script>

        <script>
        $(document).ready(function() {
            $("#roomtype").DataTable();
        });
        </script>

    </body>

</html>
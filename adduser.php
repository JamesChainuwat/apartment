<?php
    include('connect.php');
    session_start();

    if(empty($_SESSION['id'])){
        header("location:login.php");
    }

    if(isset($_POST['add'])){
        $user_name = $_POST['user_name'];
        $user_pass = $_POST['user_pass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $id_card = $_POST['id_card'];
        $subdistrict = $_POST['subdistrict'];
        $district = $_POST['district'];
        $province = $_POST['province'];
        $zip_code = $_POST['zip_code'];  
        $tel = $_POST['tel'];
        $line_id = $_POST['line_id'];
        $user_img = $_FILES['user_img']; 
        $tempNameuserPicture = $user_img['tmp_name'];
        $imguserPicture = addslashes(file_get_contents($tempNameuserPicture));
        $first_water_unit = $_POST['first_water_unit'];

        $room_id = isset($_POST["room_name"]) ? mysqli_real_escape_string($conn, $_POST["room_name"]) : NULL;
        $move_in_date = isset($_POST["move_in_date"]) ? mysqli_real_escape_string($conn, $_POST["move_in_date"]) : NULL;
        $query = getData("SELECT * FROM `tbl_user` WHERE user_name = '$user_name'");

        if (!empty($query)) {
            // ใช้ข้อมูลของแถวแรกในกรณีที่มีหลายแถวที่ตรงเงื่อนไข
            $data = $query[0];
            if($data['user_name'] == $user_name){
                // echo '<script>alert("Username ของคุณถูกปิดการใช้งาน"); window.location.href = "login.php";</script>';
                echo "<!DOCTYPE html>
                  <html>
                  <head>
                  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head>
                  <body>
                  <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'ข้อมูลซ้ำ',
                    }).then(function() {
                        window.location = 'user.php';
                    });
                  </script>
                  </body>
                  </html>";
        }}else{
        if(!empty($_POST['services'])){

            $services = $_POST['services'];
            $intServices = array_map('intval', $services);
            $saveServices = json_encode($intServices);

            if(!empty($room_id) && !empty($move_in_date)){
                $sql="INSERT INTO `tbl_user` (user_name,user_pass,fname,lname,id_card,subdistrict,district,province,zip_code,tel,line_id,user_img,stay_date,u_status,room_id,serve_id,first_water_unit)
                values('$user_name','$user_pass','$fname','$lname','$id_card','$subdistrict','$district','$province','$zip_code','$tel','$line_id','$imguserPicture',".($move_in_date ? "'$move_in_date'" : "NULL").",'1','$room_id','$saveServices','$first_water_unit')";
            }else{
                $sql="INSERT INTO `tbl_user` (user_name,user_pass,fname,lname,id_card,subdistrict,district,province,zip_code,tel,line_id,user_img,u_status,serve_id,first_water_unit)
                values('$user_name','$user_pass','$fname','$lname','$id_card','$subdistrict','$district','$province','$zip_code','$tel','$line_id','$imguserPicture','1','$saveServices','$first_water_unit')";
            }

            
            $result=mysqli_query($conn,$sql);

        }else{
            if(!empty($room_id) && !empty($move_in_date)){
                $sql="INSERT INTO `tbl_user` (user_name,user_pass,fname,lname,id_card,subdistrict,district,province,zip_code,tel,line_id,user_img,stay_date,u_status,room_id,first_water_unit)
                values('$user_name','$user_pass','$fname','$lname','$id_card','$subdistrict','$district','$province','$zip_code','$tel','$line_id','$imguserPicture',".($move_in_date ? "'$move_in_date'" : "NULL").",'1','$room_id','$first_water_unit')";
            }else{
            $sql="INSERT INTO `tbl_user` (user_name,user_pass,fname,lname,id_card,subdistrict,district,province,zip_code,tel,line_id,user_img,stay_date,u_status,first_water_unit)
        values('$user_name','$user_pass','$fname','$lname','$id_card','$subdistrict','$district','$province','$zip_code','$tel','$line_id','$imguserPicture',".($move_in_date ? "'$move_in_date'" : "NULL").",'1','$first_water_unit')";
            }
            
            $result=mysqli_query($conn,$sql);

        }


        // $lastId = insert($sql);

        // var_dump($room_id);
        // var_dump($move_in_date);

        if($result){

            // $query = exceData("UPDATE `tbl_user` SET `room_id` = '$room_id', `stay_date` = '$move_in_date' WHERE `user_id` = '$lastId';");
            $query2 = exceData("UPDATE `tbl_room` SET `ro_id` = '2' WHERE `tbl_room`.`room_id` = '$room_id'");

            if($query2){
                echo "<!DOCTYPE html>
                <html>
                <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                </head>
                <body>
                <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Add Success',
                      text: 'เพิ่มข้อมูลผู้เช่าและลงทะเบียนห้องเช่า เรียบร้อย',
                  }).then(function() {
                      window.location = 'user.php';
                  });
                </script>
                </body>
                </html>";
            } else {
                echo "<!DOCTYPE html>
                <html>
                <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                </head>
                <body>
                <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Add Success',
                      text: 'เพิ่มข้อมูลผู้เช่าเรียบร้อย',
                  }).then(function() {
                      window.location = 'user.php';
                  });
                </script>
                </body>
                </html>";
            }
            
            
            }
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
                <div class="container">
                    <div class="text-center mb-4">
                        <h3>เพิ่มข้อมูล</h3>

                    </div>
                    <div class="container d-flex justify-content-center">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" name="user_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>รหัสผ่าน</label>
                                    <input type="password" class="form-control" name="user_pass" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ</label>
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>นามสกุล</label>
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>เลขบัตรประชาชน</label>
                                <input type="text" class="form-control" name="id_card" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ตำบล</label>
                                    <input type="text" class="form-control" name="subdistrict" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>อำเภอ</label>
                                    <input type="text" class="form-control" name="district" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>จังหวัด</label>
                                    <input type="text" class="form-control" name="province" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" name="zip_code" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>เบอร์โทร</label>
                                    <input type="text" class="form-control" name="tel" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ไลน์</label>
                                    <input type="text" class="form-control" name="line_id" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>หน่วยค่าน้ำแรกเข้า</label>
                                <input type="text" class="form-control" name="first_water_unit">
                            </div>
                            <div class="form-check my-2">
                                <h4 class="">เพิ่ม เซอร์วิส</h4>
                                <?php
                                    $data = getData("SELECT * FROM `tbl_serve` WHERE hide_status ='0'");
                                    foreach ($data as $key => $value) {
                                    
                                ?>
                                <input class="form-check-input serve-checkbox" type="checkbox"
                                    id="checkbox_<?= $value['serve_id']?>" name="services[]"
                                    value="<?= $value['serve_id']?>">
                                <label class="form-check-label"
                                    for="checkbox_<?= $value['serve_id']?>"><?= $value['name_serve']?>
                                    <?= $value['price_serve']?> บาท</label> <br />
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input type="file" class="form-control-file" name="user_img" required>
                            </div>
                            <div class="form-group">
                                <label for="room_name">ชื่อห้องเช่า:</label>

                                <select class="form-control" id="room_name" name="room_name" required>
                                    <option value="NULL" selected>เลือกห้องเช่า</option>

                                    <?php
                                    $query = getData('SELECT * FROM `tbl_room`
                                    INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
                                    WHERE tbl_room.hide_status = 0 AND tbl_room.ro_id = 1' );
                                    foreach($query as $i => $data){
                                ?>
                                    <option value="<?= $data['room_id']?>"><?= $data['room_name']?> <?= $data['roomtype_name']?></option>
                                    <?php }?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="move_in_date">วันที่เข้าพัก:</label>
                                <input type="date" class="form-control" id="move_in_date" name="move_in_date">
                            </div>
                            <button type="submit" name="add" class="btn btn-success">ยืนยัน</button>
                            <a class="btn btn-danger" href="user.php" role="button">ยกเลิก</a>
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
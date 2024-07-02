<?php 
    session_start();
    include "connect.php";

    if(empty($_SESSION['id'])){
        header("location:login.php");
    }

    $user_id_rental = $_GET['id'];
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
                        <div class="container mt-5 bg-white">
                            <h2 class="text-center">ฟอร์มคิดค่าเช่า</h2>
                            <form method="post" action="bill_user_save.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <!-- <label for="roomNumber">เลขห้อง:</label> -->
                                    <h4 class="mt-4 mb-3">เลขห้อง:</h4>

                                    <?php
                                        $room_rent = getData("SELECT *,tbl_room.room_id ri,bill_water_now bwn FROM `tbl_user`
                                        INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
                                        INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id
                                        LEFT JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_room.room_id AND tbl_room_bill.user_id = '$user_id_rental'
                                        where tbl_user.user_id = '$user_id_rental'
                                        ORDER BY tbl_room_bill.bill_date DESC LIMIT 1
                                        ");

                                        ?>
                                    <input type="text" class="form-control" id="roomNumber" placeholder="กรอกเลขห้อง"
                                        name="roomNumber" value="<?= $room_rent['0']["room_name"];?>" readonly>
                                    <input type="hidden" value="<?= $room_rent['0']["ri"];?>" name="room_id">
                                    <input type="hidden" name="user_id_rental" value="<?= $user_id_rental?>">
                                </div>

                                <div class="form-group">
                                    <h4 class="mt-4 mb-3">รอบบิล:</h4>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="rentAmount">ค่าเช่า:</label> -->
                                    <h4 class="mt-4 mb-3">ค่าเช่า:</h4>
                                    <?php
                                        $room_rent_price = getData("SELECT * FROM `tbl_user`
                                        INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
                                        INNER JOIN tbl_room_type on tbl_room_type.type_id = tbl_room.ref_type_id where tbl_user.user_id = '$user_id_rental'");

                                        ?>
                                    <input type="text" class="form-control" id="rentAmount" placeholder="กรอกค่าเช่า"
                                        name="rentAmount" value="<?= $room_rent_price['0']["roomtype_price"];?>" readonly>

                                </div>

                                <h4 class="mt-4 mb-3">ค่าน้ำ</h4>
                                <label for="waterMeterCurrent">หน่วยน้ำแรกเข้า</label>
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="first_water" placeholder="กรอกค่าเช่า"
                                            name="first_water" value="<?= $room_rent_price['0']["first_water_unit"];?>" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="waterMeterCurrent">เลขมิเตอร์ครั้งนี้:</label>
                                        <input type="number" class="form-control" id="waterMeterCurrent"
                                            name="waterMeterCurrent" placeholder="กรอกเลขมิเตอร์" min="<?= $room_rent['0']["bwn"]?>">
                                    </div>

                                    
                                    <div class="form-group col-md-3">
                                        <label for="waterMeterPrevious">ครั้งก่อน:</label>

                                        <?php
                                        if(empty($room_rent['0']["bwn"])){
                                        ?>
                                        <input type="number" class="form-control" id="waterMeterPrevious"
                                            name="waterMeterPrevious" placeholder="กรอกเลขมิเตอร์">
                                        <?php
                                        }else{
                                        ?>
                                        <input type="number" class="form-control" id="waterMeterPrevious"
                                            name="waterMeterPrevious" value="<?= $room_rent['0']["bwn"]?>" readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="waterUnit">หน่วยที่ใช้:</label>
                                        <input type="text" class="form-control" id="waterUnit" placeholder="กรอกหน่วย"
                                            name="waterUnit" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="waterPricePerUnit">ราคา/หน่วย:</label>
                                        <?php
                                        $query = getData("SELECT * FROM `tbl_utility` where status = 1");
                                        ?>
                                        <input type="text" class="form-control" id="waterPricePerUnit"
                                            value="<?= $query['0']['price_unit'];?>" readonly name="waterPricePerUnit">

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="waterTotal">รวม(บาท):</label>
                                        <input type="text" class="form-control" id="waterTotal" readonly
                                            name="waterTotal">
                                    </div>

                                    <label for="waterPicture">รูปภาพบิลค่าน้ำ:</label>
                                    <input type="file" class="form-control" name="waterPicture" id="waterPicture">

                                </div>

                                <!-- <h4 class="mt-4 mb-3">ค่าไฟ</h4> -->
                                <!-- <div class="form-group">
                                </div> -->

                                <div class="form-group">
                                    <h4 class="mt-4 mb-3">ค่าไฟ:</h4>
                                    <input type="text" class="form-control" id="electricTotal" placeholder="กรอกค่าไฟฟ้า"
                                        name="electricTotal" value="">
                                        <!-- <h4 class="mt-4 mb-3">รูปภาพบิลค่าไฟฟ้า:</h4> -->

                                    <label for="electricPicture" class="mt-3">รูปภาพบิลค่าไฟฟ้า:</label>
                                    <input type="file" class="form-control" name="electricPicture" id="electricPicture">

                                </div>

                                <div class="form-group">
                                    <!-- <label for="services" class="form-label">เลือกเซอร์วิส:</label> -->
                                    <h4 class="mt-4">เซอร์วิส:</h4>
                                    <?php
                                    $service = getData("SELECT * FROM `tbl_serve`");
                                    $service2 = getData("SELECT * FROM `tbl_user` where user_id = '$user_id_rental'");
                                    // var_dump($service2[0]['serve_id']);
                                    $service_decode = json_decode($service2[0]['serve_id']) ?: [] ;
                                    foreach ($service_decode as $key => $service_user) {
                                        foreach ($service as $number => $value) {
                                            if($service_user == $value['serve_id']){
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input serve-checkbox" type="checkbox" name="services_show" value="<?= $value['price_serve']?>" id="checkbox<?= $value['serve_id']?>" checked disabled>
                                        <input class="form-check-input serve-checkbox" type="hidden" name="services[]" value="<?= $value['price_serve']?>" id="checkbox<?= $value['serve_id']?>" checked>
                                        <label class="form-check-label" for="checkbox<?= $value['serve_id']?>">
                                            <?= $value['name_serve']?> <?= $value['price_serve']?> บาท
                                        </label>
                                        <!-- <label for="electricPicture" class="mt-3"><?= $value['name_serve']?> <?= $value['price_serve']?> บาท</label>
                                        <input type="text" class="form-control" name="services[]" value="<?= $value['price_serve']?>" id="checkbox" readonly name="totalAmount"> -->
                                    </div>
                                    <?php }}}?>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="totalAmount">รวมทั้งสิ้น:</label> -->
                                    <h4 class="mt-4">รวมทั้งสิ้น:</h4>

                                    <input type="text" class="form-control" id="totalAmount" readonly name="totalAmount">
                                </div>

                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <!-- <button type="submit" class="btn btn-primary">กลับ</button> -->
                                <a href="bill.php" class="btn btn-info">กลับ</a>
                            </form>
                        </div>
                        <hr>
                        <?php
                            $name_user = getData("SELECT * FROM `tbl_user` where user_id = '$user_id_rental'");
                        ?>
                        <center><h2 class="mt-4 mb-4">รายการบิล : ผู้เช่าปัจจุบัน <?= $name_user['0']['fname']?> <?= $name_user['0']['lname']?></h2></center>

                        <!-- <div class="text-right mb-3">
                            <a href="?create=create" class="btn btn-success">เพิ่ม</a>
                        </div> -->
                        <div class="container bg-white">
                        <table class="container table table-bordered bg-white" id="bill_user">
                            <thead>
                                <tr>
                                    <th>เลขบิล</th>
                                    <th>รอบบิล</th>
                                    <th>ค่าเช่า</th>
                                    <th>ค่าน้ำรวม</th>
                                    <th>ค่าไฟรวม</th>
                                    <th>ค่าบริการ</th>
                                    <th>รวมทั้งหมด</th>
                                    <th>สถานะ</th>
                                    <th>ส่งบิลไปที่ ไลน์</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- แสดงข้อมูลที่ดึงมาจากฐานข้อมูล -->
                                <?php
                                    $query2 = getData("SELECT *,tbl_room_bill.bill_id rbi,tbl_user.user_id uuser_id FROM `tbl_user`
                                    INNER JOIN tbl_room on tbl_room.room_id = tbl_user.room_id
                                    INNER JOIN tbl_room_type ON tbl_room_type.type_id = tbl_room.ref_type_id 
                                    INNER JOIN tbl_room_bill on tbl_room_bill.room_id = tbl_user.room_id AND tbl_room_bill.user_id = '$user_id_rental' WHERE tbl_user.user_id = '$user_id_rental'");
                                    foreach($query2 as $i => $data){
                                ?>

                                <tr>
                                    <td><?= $data['bill_id']?></td>
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
                                        <a href="bill_user_line.php?user_id=<?= $data['uuser_id']?>&rbi=<?= $data['rbi']?>" type="button"
                                            class="btn btn-primary ">ส่งค่าเช่า</a>
                                    </td>
                                    <td>

                                        <!-- <a href="javascript:void(0);" onclick="confirmDeletion('<?= $data['rbi'] ?>', '<?= $data['uuser_id'] ?>')" type="button" class="btn btn-danger">ลบ</a> -->
                                        <?php
                                            if($data['bill_status'] == 0){
                                            ?>
                                                <a href="javascript:void(0);" onclick="confirmDeletion('<?= $data['rbi'] ?>', '<?= $data['uuser_id'] ?>')" type="button" class="btn btn-danger">ลบ</a>
                                            <?php
                                            }else if($data['bill_status'] == 1){
                                            ?>
                                                <button type="button" class="btn btn-success" disabled>จ่ายแล้ว ไม่สามารถลบได้</button>
                                            <?php
                                            }else{
                                        ?>
                                                <button type="button" class="btn btn-warning" disabled>รอตรวจสอบ ไม่สามารถลบได้</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->
                            </tbody>
                        </table>
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
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#bill_user").DataTable();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function confirmDeletion(id, userId) {
        Swal.fire({
            title: 'คุณแน่ใจไหม?',
                text: "ยืนยันเพื่อดำเนินการลบต่อ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ลบ'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed the deletion
                window.location.href = `bill_user_delete.php?id=${id}&user_id=${userId}`
            }
        });
    }
    </script>

    <script>
        
        // คำนวณหน่วยที่ใช้ของค่าน้ำ
        $('#waterMeterCurrent, #waterMeterPrevious').on('input', function() {
            var currentMeter = parseFloat($('#waterMeterCurrent').val()) || 0;
            var previousMeter = parseFloat($('#waterMeterPrevious').val()) || 0;
            var waterUnit = currentMeter - previousMeter;
            $('#waterUnit').val(waterUnit.toFixed(2));

            // คำนวณค่าน้ำ
            var waterPricePerUnit = parseFloat($('#waterPricePerUnit').val()) || 0;
            $('#waterTotal').val((waterUnit * waterPricePerUnit).toFixed(2));

            // คำนวณรวมทั้งสิ้น
            calculateTotalAmount();
        });

        // คำนวณหน่วยที่ใช้ของค่าไฟ
        // $('#electricMeterCurrent, #electricMeterPrevious').on('input', function() {
            // var currentMeter = parseFloat($('#electricMeterCurrent').val()) || 0;
            // var previousMeter = parseFloat($('#electricMeterPrevious').val()) || 0;
            // var electricUnit = currentMeter - previousMeter;
            // $('#electricUnit').val(electricUnit.toFixed(2));

            // คำนวณค่าไฟ
            // var electricPricePerUnit = parseFloat($('#electricPricePerUnit').val()) || 0;
            // $('#electricTotal').val((electricUnit * electricPricePerUnit).toFixed(2));

            // คำนวณรวมทั้งสิ้น
            // calculateTotalAmount();
        // });

        // คำนวณรวมทั้งสิ้น
        $('#rentAmount, #waterTotal, #electricTotal').on('input', function() {
            calculateTotalAmount();
        });

        $('.serve-checkbox').on('change', function() {
            // เรียกใช้ฟังก์ชันคำนวณรวมทั้งสิ้น
            calculateTotalAmount();
        });

        function calculateTotalAmount(p) {
            var rentAmount = parseFloat($('#rentAmount').val()) || 0;
            var waterTotal = parseFloat($('#waterTotal').val()) || 0;
            var electricTotal = parseFloat($('#electricTotal').val()) || 0;

            // ราคาเซอร์วิสที่ถูกติ๊ก
            var selectedServicesTotal = 0;

            // วนลูปตรวจสอบ checkbox
            $('.serve-checkbox:checked').each(function() {
                // นำราคาของเซอร์วิสที่ถูกติ๊กมาบวกกัน
                selectedServicesTotal += parseFloat($(this).val());
            });

            var totalAmount = rentAmount + waterTotal + electricTotal + selectedServicesTotal;
            $('#totalAmount').val(totalAmount.toFixed(2));
        }

        
    </script>

</body>

</html>
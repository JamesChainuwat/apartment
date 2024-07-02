<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <h6 class="sidebar-brand-text mx-3 ">Hello 
            <?= $_SESSION['fname']?> <?= $_SESSION['lname']?>
        </h6>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachoindexmeter-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>ข้อมูลผู้เช่า</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ลงทะเบียนข้อมูลผู้เช่า</h6>
                <!-- <a class="collapse-item" href="login.php">Login</a> -->
                <a class="collapse-item" href="user.php">จัดการผู้เช่า</a>
                <a class="collapse-item" href="admin.php">จัดการผู้ดูแลระบบ</a>
                <a class="collapse-item" href="bank.php">จัดการบัญชีธนาคาร</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>ลงทะเบียนห้องเช่า</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ลงทะเบียนห้องเช่า</h6>
                <a class="collapse-item" href="register_user_room.php">ลงข้อมูลงทะเบียน ย้ายเข้า</a>
                <a class="collapse-item" href="register_user_room_out.php">ลงข้อมูลงทะเบียน ย้ายออก</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ระบบ
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>ระบบห้องเช่า</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ระบบห้องเช่าต่างๆ :</h6>
                <a class="collapse-item" href="roomtype.php">ข้อมูลประเภทห้องเช่า</a>
                <a class="collapse-item" href="room.php">ข้อมูลห้องเช่า</a>
                <a class="collapse-item" href="utility.php">ข้อมูลสาธารณูปโภค</a>
                <a class="collapse-item" href="serve.php">ข้อมูลบริการเสริม</a>               
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true"
            aria-controls="collapsePages2">
            <i class="fas fa-fw fa-folder"></i>
            <span>ระบบคิดค่าห้องเช่า</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ระบบต่างๆ :</h6>
                <a class="collapse-item" href="bill.php">คิดค่าเช่าห้อง</a>
                <a class="collapse-item" href="report_payment.php">รายงานค่าเช่า</a>
            </div>
        </div>
    </li>
</ul>
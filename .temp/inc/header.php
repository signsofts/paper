<?php

if (isset ($_POST["AD_USERNAME"]) || isset ($_POST["AD_PASSWORD"])) {

    $AD_USERNAME = $_POST["AD_USERNAME"];
    $AD_PASSWORD = $_POST["AD_PASSWORD"];


    $q = Database::squery("SELECT * FROM `shr_admin` WHERE AD_USERNAME = '$AD_USERNAME'  AND AD_PASSWORD ='$AD_PASSWORD' ", PDO::FETCH_OBJ, false);

    if ($q) {
        $_SESSION["login"] = $q->AD_ID;
    } else {
        echo "<script>alert('เข้าระบบไม่สำเร็จ')</script>";
        echo "<script>setTimeout(() => {location.assign('./login.php');}, 500);</script>" ;
    }
}




if(!isset($_SESSION["login"]) || empty($_SESSION["login"])){
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อน')</script>";
    echo "<script>setTimeout(() => {location.assign('./login.php');}, 500);</script>" ;  
}

?>




<!-- Spinner Start -->
<!-- <div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-light p-0" style="display:  none;">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <!-- <small class="fa fa-map-marker-alt text-primary me-2"></small> -->
                <!-- <small>123 Street, New York, USA</small> -->
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <!-- <small class="far fa-clock text-primary me-2"></small> -->
                <!-- <small>Mon - Fri : 09.00 AM - 09.00 PM</small> -->
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <!-- <small>+66 987 654 321</small> -->
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <!-- <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a> -->
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="favicon.png" alt="" srcset="" width="60px">
        <h2 class="m-0 text-primary"> SJ Shrimp Pond </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0  ">
            <a href="index.php" class="nav-item nav-link <?php echo $activeHome ?? '' ?>">หน้าหลัก</a>
            <a href="history.php" class="nav-item nav-link <?php echo $activeHistory ?? '' ?>">ประวัติการเลี้ยงกุ้ง</a>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle <?php echo !empty ($activeBreed) || !empty ($activeFood) || !empty ($activePond) ? "active" : '' ?>"
                    data-bs-toggle="dropdown">จัดการ</a>
                <div class="dropdown-menu fade-up m-0">
                    <!-- <a href="breed.php" class="dropdown-item <?php echo $activeBreed ?? '' ?>">สายพันธุ์กุ้ง</a> -->
                    <a href="foodtype.php" class="dropdown-item <?php echo $activeFood ?? '' ?>">อาหาร</a>
                    <a href="pond.php" class="dropdown-item <?php echo $activePond ?? '' ?>">บ่อกุ้ง</a>
                </div>
            </div>
            <a href="./logout.php" class="nav-item nav-link">ออกจากระบบ</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<!DOCTYPE html>
<html lang="en">
<?php include("../config/connectdb.php") ?>

<?php
if (!isset($_SESSION["type"])) {
    echo "<script>alert('กรุณาเข้าสู่ระบบ');location.assign('../login.php');</script>";
}
if (isset($_SESSION["type"]) && ($_SESSION["type"] != "user" &&  $_SESSION["type"]  == "admin")) {
    echo "<script>alert('เข้าสู่ระบบสำเร็จ');location.assign('../a/index.php');</script>";
}



$U_ID = $_SESSION["id"];

$uAuccotu = Database::squery("SELECT * , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname FROM `paper_user` INNER JOIN provinces ON provinces.code = paper_user.provinces_code INNER JOIN district ON district.code = paper_user.district_code INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
    WHERE US_ID = '$U_ID'", PDO::FETCH_OBJ, false);
if (empty($uAuccotu)) {
    echo "<script>alert('กรุณาเข้าสู่ระบบ');location.assign('../login.php');</script>";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน (Receipt) </title>
</head>
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px #FFFF solid;
        height: 257mm;
        outline: 2cm #FFFF solid;
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    @font-face {
        font-family: 'KhaoNiawThin';
        /* src: url('KhaoNiawThin.eot'); */
        /* IE9 Compat Modes */
        src:
            url('../KhaoNiawThin.ttf') format('truetype'),
    }

    * {
        font-family: 'KhaoNiawThin' !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/ju/jqc-1.12.4/dt-2.0.3/datatables.min.css" rel="stylesheet"> -->

<body>
    <?php
    $sql_data = "SELECT * FROM `transale` WHERE id_transale  = '{$_GET['ID']}'";
    $transale = Database::query($sql_data, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
    ?>

    <?php //print_r($transale); 
    ?>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center ">
                        <h6>ใบเสร็จรับเงิน (Receipt) <span style="background-color: black;" class="p-2 text-white"> #TRAN<?php echo  $_GET["ID"] ?> </span> </h6>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <style>
                        p {
                            margin: 0;
                            padding: 0;
                        }
                    </style>
                    <div class="col-7 text-left">
                        <h5>ร้านค้าผู้ให้บริการ</h5>
                        <p>155/69 ซอยมังกร-ขันดี 4 ต.เทพารักษ์ อ.เมืองสมุทรปราการ จ.สมุทรปราการ 10270</p>
                        <p>เลขประจำตัวภาษี 020334619373377</p>
                        <p>ติดต่อ 024578991</p>
                    </div>
                    <div class="col-5 text-left">
                        <h5>รายละเอียดลูกค้า</h5>
                        <p><?php echo $uAuccotu->US_FNAME . " " . $uAuccotu->US_LNAME; ?></p>
                        <p>ติดต่อ <?php echo $uAuccotu->US_PHONE ?></p>
                        <p>วันที่ <?php echo date("d/m/Y", strtotime($transale->date_transale)) ?></p>
                        <p>ชำระผ่านทาง <?php echo $transale->tra_type_post == '1' ? " กสิกรไทย" : " เก็บปลายทาง" ?></p>
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-12">
                        <table style="width: 100%; height: auto; ">
                            <thead>
                                <tr class="pt-4 pb-4" style="border-top: 1px #111 solid ; border-bottom:1px #111 solid ;">
                                    <td style="width: 1%;" class="pt-2 pb-2"></td>
                                    <td style="width: 40%;" class="pt-2 pb-2">รายการสินค้า</td>
                                    <td style="width: 5%;" class="pt-2 pb-2">จำนวน</td>
                                    <td style="width: 15%;" class="pt-2 pb-2">ราคาต่อหน่วย</td>
                                    <td style="width: 15%;" class="pt-2 pb-2">จำนวนเงิน</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$transale->id_transale';";
                                $result_datas = Database::query($sql_dataa, PDO::FETCH_OBJ);
                                $sump = 0; ?>

                                <?php foreach ($result_datas as $ks => $rowde) :
                                ?>
                                    <tr>
                                        <td class="pt-2 pb-2"><?php echo $ks + 1 ?>.</td>
                                        <td class="pt-2 pb-2" scope="col" class="">
                                            <img class="pr-2 pl-2" style="width: 52px; height: 52px; " src="../img/pro/<?php echo $rowde->image_pro ?>" class="img-fluid" alt="image">
                                            &nbsp;&nbsp;&nbsp;<?php echo $rowde->name_products ?>
                                        </td>
                                        <td class="pt-2 pb-2" scope="col" class=" d-flex justify-content-center">
                                            <?php echo $rowde->num_item ?></td>
                                        <td class="pt-2 pb-2" scope="col" class=""><?php echo  number_format($rowde->price_unit) ?> บาท</td>
                                        <td class="pt-2 pb-2" scope="col" class=""><?php echo  number_format($rowde->num_item * $rowde->price_tran) ?> บาท</td>
                                    </tr>
                                    <?php
                                    $sump += $rowde->num_item * $rowde->price_tran;
                                    ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5" class="pt-2 pb-2"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="pt-2 pb-2"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="pt-2 pb-2"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="mt-5" style="border-top: 1px #111 solid ; border-bottom:1px #111 solid ;">
                                    <td style="width: 1%;" class="pt-2 pb-2"></td>
                                    <td style="width: 40%;" class="pt-2 pb-2"></td>
                                    <td style="width: 5%;" class="pt-2 pb-2"></td>
                                    <td style="width: 15%;" class="pt-2 pb-2"></td>
                                    <td style="width: 15%;" class="pt-2 pb-2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6 bg-light pt-3">
                        <h6>หมายเหตุ</h6>
                        <p>-</p>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between ">
                            <h6>ทั้งหมด</h6>
                            <h6><?php echo number_format($sump); ?> บาท</h6>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <h6>ส่วนลด</h6>
                            <h6><?php echo number_format(0); ?> บาท</h6>
                        </div>
                        <div class="d-flex justify-content-between bg-light ">
                            <h6>รวมราคาสุธิ</h6>
                            <h6><?php echo number_format($sump); ?> บาท</h6>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-5 ">
                    <p>ขอบคุณที่ใช้บริการ (Thank You)</p>
                </div>


                <div style="display: block;" class="d-flex justify-content-center mt-5 ">
                    <button id="bb-ttn1" style="display: block;" class="btn btn-sm btn-outline-primary m-2" onclick="print_rr()">พิมพ์</button>
                    <?php if (isset($_GET["t"])) : ?>
                        <a id="bb-ttn2" style="display: block;" href="./account.php" class="btn btn-sm btn-dark m-2">กลับ</a>
                    <?php else : ?>
                        <a id="bb-ttn2" style="display: block;" href="./index.php" class="btn btn-sm btn-dark m-2">กลับหน้าหลัก</a>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>
</body>
<script src="../js/jquery-1.11.0.min.js?v=<?php echo time() ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/v/ju/jqc-1.12.4/dt-2.0.3/datatables.min.js"></script> -->

<script>
    // window.print();
    function print_rr() {
        document.getElementById("bb-ttn1").style.display = 'none';
        document.getElementById("bb-ttn2").style.display = 'none';
        window.print();
        // document.getElementById("bb-ttn").style.display = 'block';
        document.getElementById("bb-ttn1").style.display = 'block';
        document.getElementById("bb-ttn2").style.display = 'block';

    }
</script>

</html>
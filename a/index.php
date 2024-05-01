<!DOCTYPE html>
<html lang="en">



<head>
    <?php include("inc/head.php") ?>
</head>

<body class="">

    <?php include("inc/header.php") ?>

    <?php



    // $rwRco = Database::squery("SELECT * FROM `paper_user` WHERE US_ID = '{$_SESSION["id"]}'", PDO::FETCH_OBJ, false);

    // print_r($rwRco);
    // exit;
    // $result_data = Database::query('', PDO::FETCH_ASSOC);
    ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">ข้อมูลคำสั่งซื้อ</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">หน้าหลัก</a>
                    <span class="breadcrumb-item active" aria-current="page">ข้อมูลคำสั่งซื้อ</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="shopify-grid">
        <div class="container py-5 my-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="h3-tab" data-bs-toggle="tab" data-bs-target="#h3-tab-pane" type="button" role="tab" aria-controls="h3-tab-pane" aria-selected="false">คำสั่งซื้อรอยืนยัน</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="h1-tab" data-bs-toggle="tab" data-bs-target="#h1-tab-pane" type="button" role="tab" aria-controls="h1-tab-pane" aria-selected="false">รอจัดส่ง</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="h2-tab" data-bs-toggle="tab" data-bs-target="#h2-tab-pane" type="button" role="tab" aria-controls="h2-tab-pane" aria-selected="false">กำลังจัดส่ง</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="h5-tab" data-bs-toggle="tab" data-bs-target="#h5-tab-pane" type="button" role="tab" aria-controls="h5-tab-pane" aria-selected="false">จัดส่งสำเร็จ</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="h4-tab" data-bs-toggle="tab" data-bs-target="#h4-tab-pane" type="button" role="tab" aria-controls="h4-tab-pane" aria-selected="false">ถูกยกเลิก</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="h3-tab-pane" role="tabpanel" aria-labelledby="h3-tab" tabindex="0">

                    <table class="table table-bordered w-100">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <!-- <th>เลขติดตาม</th> -->
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                            WHERE status_transale = '1'";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td><?php echo  $row->US_FNAME . " " . $row->US_LNAME  ?></td>
                                    <td><?php echo "$row->US_ADDESS ตำบล $row->dsname อำเภอ $row->dname จังหวัด $row->pname  $row->zip_code "   ?></td>
                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>รอจัดส่ง</span>";
                                                break;
                                            case '3':
                                                $stat = "<span class='badge rounded-pill text-bg-warning'>กำลังจัดส่ง</span>";

                                                break;
                                            case '4':
                                                $stat = "<span class='badge rounded-pill text-bg-success'>จัดส่งสำเร็จ</span>";

                                                break;
                                            case '5':
                                                $stat = "<span class='badge rounded-pill text-bg-danger'>ยกเลิก</span>";

                                                break;
                                        }
                                        echo  $stat;
                                        ?>
                                    </td>
                                    <td><?php
                                        $trpost = "";
                                        switch ($row->tra_type_post) {
                                            case '0':
                                                $trpost = "<span class='badge rounded-pill text-bg-primary'>ปลายทาง</span>";
                                                break;
                                            case '1':
                                                $trpost = "<a href='../img/slip/{$row->tra_slip}' target='_blank' rel='noopener noreferrer'><span class='badge rounded-pill text-bg-info'>โอนชำระ(คลิก)</span></a>";
                                                break;
                                        }
                                        echo  $trpost;
                                        ?></td>
                                    <!-- <td><?php echo  $row->tra_number_tag ?? "-" ?></td> -->
                                    <td>
                                        <button type="button" style="padding: 6px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>



                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <?php

                    $sql_data = "SELECT *
                    , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                     FROM `transale` 
                           INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                           INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                           INNER JOIN district ON district.code = paper_user.district_code 
                           INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                    WHERE status_transale = '1'";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>

                        <div class="modal fade" id="transale-<?php echo  $row->id_transale ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รายละเอียดคำส่งซื้อ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">

                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th scope="col" class="text-uppercase">ชื่อสินค้า</th>
                                                            <th scope="col" class="text-uppercase">จำนวน</th>
                                                            <th scope="col" class="text-uppercase">ราคา/ลัง</th>
                                                            <th scope="col" class="text-uppercase">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$row->id_transale';";
                                                        $result_datas = Database::query($sql_dataa, PDO::FETCH_ASSOC); ?>
                                                        <?php foreach ($result_datas as $ks => $rowde) :
                                                            $rowde = (object) $rowde;
                                                        ?>
                                                            <tr>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->name_products ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->num_item ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->price_unit ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo  $rowde->num_item * $rowde->price_tran ?> บาท</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12">
                                                <h4>แบบที่ลูกค้าจะพิมพ์</h4>
                                                <img src="./../img/modal/<?php echo $row->tra_modal_type ?>" width="50%" height="200px" alt="" srcset="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <?php if ($row->status_transale == '1') : ?>
                                            <button type="button" onclick="cancelTransale('<?php echo $row->id_transale; ?>')" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button>
                                            <button type="button" onclick="confilmTransale('<?php echo $row->id_transale; ?>')" class="btn btn-success">ยืนยันคำสั่งซื้อ</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>

                </div>

                <div class="tab-pane fade" id="h1-tab-pane" role="tabpanel" aria-labelledby="h1-tab" tabindex="0">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <!-- <th>เลขติดตาม</th> -->
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                            WHERE status_transale = '2'";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td style="width: 1%;"><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td><?php echo  $row->US_FNAME . " " . $row->US_LNAME  ?></td>
                                    <td><?php echo "$row->US_ADDESS ตำบล $row->dsname อำเภอ $row->dname จังหวัด $row->pname  $row->zip_code "   ?></td>

                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>รอจัดส่ง</span>";
                                                break;
                                            case '3':
                                                $stat = "<span class='badge rounded-pill text-bg-warning'>กำลังจัดส่ง</span>";

                                                break;
                                            case '4':
                                                $stat = "<span class='badge rounded-pill text-bg-success'>จัดส่งสำเร็จ</span>";

                                                break;
                                            case '5':
                                                $stat = "<span class='badge rounded-pill text-bg-danger'>ยกเลิก</span>";

                                                break;
                                        }
                                        echo  $stat;
                                        ?>
                                    </td>
                                    <td><?php
                                        $trpost = "";
                                        switch ($row->tra_type_post) {
                                            case '0':
                                                $trpost = "<span class='badge rounded-pill text-bg-primary'>ปลายทาง</span>";
                                                break;
                                            case '1':
                                                $trpost = "<a href='../img/slip/{$row->tra_slip}' target='_blank' rel='noopener noreferrer'><span class='badge rounded-pill text-bg-info'>โอนชำระ(คลิก)</span></a>";
                                                break;
                                        }
                                        echo  $trpost;
                                        ?></td>
                                    <!-- <td><?php echo  $row->tra_number_tag ?? "-" ?></td> -->
                                    <td>
                                        <button type="button" style="padding: 6px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>




                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <?php

                    $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                    WHERE status_transale = '2'";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>

                        <div class="modal fade" id="transale-<?php echo  $row->id_transale ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รายละเอียดคำส่งซื้อ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">

                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th scope="col" class="text-uppercase">ชื่อสินค้า</th>
                                                            <th scope="col" class="text-uppercase">จำนวน</th>
                                                            <th scope="col" class="text-uppercase">ราคา/ลัง</th>
                                                            <th scope="col" class="text-uppercase">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$row->id_transale';";
                                                        $result_datas = Database::query($sql_dataa, PDO::FETCH_ASSOC); ?>
                                                        <?php foreach ($result_datas as $ks => $rowde) :
                                                            $rowde = (object) $rowde;
                                                        ?>
                                                            <tr>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->name_products ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->num_item ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->price_unit ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo  $rowde->num_item * $rowde->price_tran ?> บาท</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12">
                                                <h4>แบบที่ลูกค้าจะพิมพ์</h4>
                                                <img src="./../img/modal/<?php echo $row->tra_modal_type ?>" width="50%" height="200px" alt="" srcset="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button> -->
                                        <?php if ($row->status_transale == '2') : ?>
                                            <div class="input-group mb-3">
                                                <input id="in-tra_number_tag-<?php echo  $row->id_transale ?>" name="tra_number_tag" type="text" class="form-control" placeholder="ระบุเลขติดตามพัสดุ" aria-label="ระบุเลขติดตามพัสดุ" aria-describedby="button-addon2">
                                                <button onclick="updateNubTag('<?php echo  $row->id_transale ?>','in-tra_number_tag-<?php echo  $row->id_transale ?>')" class="btn btn-outline-success" type="button">จัดส่งสินค้า</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="h2-tab-pane" role="tabpanel" aria-labelledby="h2-tab" tabindex="0">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <th>เลขติดตาม</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                            WHERE status_transale = '3'";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  $row->US_FNAME . " " . $row->US_LNAME  ?></td>
                                    <td><?php echo "$row->US_ADDESS ตำบล $row->dsname อำเภอ $row->dname จังหวัด $row->pname  $row->zip_code "   ?></td>

                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>รอจัดส่ง</span>";
                                                break;
                                            case '3':
                                                $stat = "<span class='badge rounded-pill text-bg-warning'>กำลังจัดส่ง</span>";

                                                break;
                                            case '4':
                                                $stat = "<span class='badge rounded-pill text-bg-success'>จัดส่งสำเร็จ</span>";

                                                break;
                                            case '5':
                                                $stat = "<span class='badge rounded-pill text-bg-danger'>ยกเลิก</span>";

                                                break;
                                        }
                                        echo  $stat;
                                        ?>
                                    </td>
                                    <td><?php
                                        $trpost = "";
                                        switch ($row->tra_type_post) {
                                            case '0':
                                                $trpost = "<span class='badge rounded-pill text-bg-primary'>ปลายทาง</span>";
                                                break;
                                            case '1':
                                                $trpost = "<a href='../img/slip/{$row->tra_slip}' target='_blank' rel='noopener noreferrer'><span class='badge rounded-pill text-bg-info'>โอนชำระ(คลิก)</span></a>";
                                                break;
                                        }
                                        echo  $trpost;
                                        ?></td>
                                    <td><?php echo  $row->tra_number_tag ?? "-" ?></td>
                                    <td>
                                        <button type="button" style="padding: 6px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>



                            <?php endforeach; ?>


                        </tbody>
                    </table>


                    <?php

                    $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                    WHERE status_transale = '3'";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>

                        <div class="modal fade" id="transale-<?php echo  $row->id_transale ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รายละเอียดคำส่งซื้อ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">

                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th scope="col" class="text-uppercase">ชื่อสินค้า</th>
                                                            <th scope="col" class="text-uppercase">จำนวน</th>
                                                            <th scope="col" class="text-uppercase">ราคา/ลัง</th>
                                                            <th scope="col" class="text-uppercase">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$row->id_transale';";
                                                        $result_datas = Database::query($sql_dataa, PDO::FETCH_ASSOC); ?>
                                                        <?php foreach ($result_datas as $ks => $rowde) :
                                                            $rowde = (object) $rowde;
                                                        ?>
                                                            <tr>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->name_products ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->num_item ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->price_unit ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo  $rowde->num_item * $rowde->price_tran ?> บาท</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-12">
                                                <h4>แบบที่ลูกค้าจะพิมพ์</h4>
                                                <img src="./../img/modal/<?php echo $row->tra_modal_type ?>" width="50%" height="200px" alt="" srcset="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <?php if ($row->status_transale == '3') : ?>
                                            <!-- <button type="button" onclick="cancelTransale('<?php echo $row->id_transale; ?>')" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button> -->
                                            <!-- <button type="button" onclick="confilmTransale('<?php echo $row->id_transale; ?>')" class="btn btn-success"></button> -->
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>

                </div>
                <div class="tab-pane fade" id="h4-tab-pane" role="tabpanel" aria-labelledby="h4-tab" tabindex="0">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <!-- <th>เลขติดตาม</th> -->
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                            WHERE status_transale = '5'";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  $row->US_FNAME . " " . $row->US_LNAME  ?></td>
                                    <td><?php echo "$row->US_ADDESS ตำบล $row->dsname อำเภอ $row->dname จังหวัด $row->pname  $row->zip_code "   ?></td>
                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>รอจัดส่ง</span>";
                                                break;
                                            case '3':
                                                $stat = "<span class='badge rounded-pill text-bg-warning'>กำลังจัดส่ง</span>";

                                                break;
                                            case '4':
                                                $stat = "<span class='badge rounded-pill text-bg-success'>จัดส่งสำเร็จ</span>";

                                                break;
                                            case '5':
                                                $stat = "<span class='badge rounded-pill text-bg-danger'>ยกเลิก</span>";

                                                break;
                                        }
                                        echo  $stat;
                                        ?>
                                    </td>
                                    <td><?php
                                        $trpost = "";
                                        switch ($row->tra_type_post) {
                                            case '0':
                                                $trpost = "<span class='badge rounded-pill text-bg-primary'>ปลายทาง</span>";
                                                break;
                                            case '1':
                                                $trpost = "<a href='../img/slip/{$row->tra_slip}' target='_blank' rel='noopener noreferrer'><span class='badge rounded-pill text-bg-info'>โอนชำระ(คลิก)</span></a>";
                                                break;
                                        }
                                        echo  $trpost;
                                        ?></td>
                                    <!-- <td><?php echo  $row->tra_number_tag ?? "-" ?></td> -->
                                    <td>
                                        <button type="button" style="padding: 6px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>



                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <?php

                    $sql_data = "SELECT *
                             , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                              FROM `transale` 
                                    INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                    INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                    INNER JOIN district ON district.code = paper_user.district_code 
                                    INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                    WHERE status_transale = '5'";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>

                        <div class="modal fade" id="transale-<?php echo  $row->id_transale ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รายละเอียดคำส่งซื้อ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">

                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th scope="col" class="text-uppercase">ชื่อสินค้า</th>
                                                            <th scope="col" class="text-uppercase">จำนวน</th>
                                                            <th scope="col" class="text-uppercase">ราคา/ลัง</th>
                                                            <th scope="col" class="text-uppercase">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$row->id_transale';";
                                                        $result_datas = Database::query($sql_dataa, PDO::FETCH_ASSOC); ?>
                                                        <?php foreach ($result_datas as $ks => $rowde) :
                                                            $rowde = (object) $rowde;
                                                        ?>
                                                            <tr>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->name_products ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->num_item ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->price_unit ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo  $rowde->num_item * $rowde->price_tran ?> บาท</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-12">
                                                <h4>แบบที่ลูกค้าจะพิมพ์</h4>
                                                <img src="./../img/modal/<?php echo $row->tra_modal_type ?>" width="50%" height="200px" alt="" srcset="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <?php if ($row->status_transale == '1') : ?>
                                            <button type="button" onclick="cancelTransale('<?php echo $row->id_transale; ?>')" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button>
                                            <button type="button" onclick="confilmTransale('<?php echo $row->id_transale; ?>')" class="btn btn-success">ยืนยันคำสั่งซื้อ</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>

                </div>

                <div class="tab-pane fade" id="h5-tab-pane" role="tabpanel" aria-labelledby="h5-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12">
                            <a href="report.php" target="_blank" class="btn btn-sm btn-outline-primary" rel="noopener noreferrer">ออกรายงาน</a>
                        </div>
                    </div>
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <!-- <th>เลขติดตาม</th> -->
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT * , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                            FROM `transale` 
                                  INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                                  INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                                  INNER JOIN district ON district.code = paper_user.district_code 
                                  INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                            WHERE status_transale = '4'";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td><?php echo  $row->US_FNAME . " " . $row->US_LNAME  ?></td>
                                    <td><?php echo "$row->US_ADDESS ตำบล $row->dsname อำเภอ $row->dname จังหวัด $row->pname  $row->zip_code "   ?></td>
                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>รอจัดส่ง</span>";
                                                break;
                                            case '3':
                                                $stat = "<span class='badge rounded-pill text-bg-warning'>กำลังจัดส่ง</span>";

                                                break;
                                            case '4':
                                                $stat = "<span class='badge rounded-pill text-bg-success'>จัดส่งสำเร็จ</span>";

                                                break;
                                            case '5':
                                                $stat = "<span class='badge rounded-pill text-bg-danger'>ยกเลิก</span>";

                                                break;
                                        }
                                        echo  $stat;
                                        ?>
                                    </td>
                                    <td><?php
                                        $trpost = "";
                                        switch ($row->tra_type_post) {
                                            case '0':
                                                $trpost = "<span class='badge rounded-pill text-bg-primary'>ปลายทาง</span>";
                                                break;
                                            case '1':
                                                $trpost = "<a href='../img/slip/{$row->tra_slip}' target='_blank' rel='noopener noreferrer'><span class='badge rounded-pill text-bg-info'>โอนชำระ(คลิก)</span></a>";
                                                break;
                                        }
                                        echo  $trpost;
                                        ?></td>
                                    <!-- <td><?php echo  $row->tra_number_tag ?? "-" ?></td> -->
                                    <td>
                                        <button type="button" style="padding: 6px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>



                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <?php

                    $sql_data = "SELECT * FROM `transale` INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                    WHERE status_transale = '4'";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>

                        <div class="modal fade" id="transale-<?php echo  $row->id_transale ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รายละเอียดคำส่งซื้อ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">

                                                <table class="table table-bordered w-100">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th scope="col" class="text-uppercase">ชื่อสินค้า</th>
                                                            <th scope="col" class="text-uppercase">จำนวน</th>
                                                            <th scope="col" class="text-uppercase">ราคา/ลัง</th>
                                                            <th scope="col" class="text-uppercase">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql_dataa = "SELECT * FROM `transalede` INNER JOIN products ON products.id_products = transalede.id_products WHERE id_transale = '$row->id_transale';";
                                                        $result_datas = Database::query($sql_dataa, PDO::FETCH_ASSOC); ?>
                                                        <?php foreach ($result_datas as $ks => $rowde) :
                                                            $rowde = (object) $rowde;
                                                        ?>
                                                            <tr>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->name_products ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->num_item ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo $rowde->price_unit ?></td>
                                                                <td scope="col" class="card-title text-uppercase"><?php echo  $rowde->num_item * $rowde->price_tran ?> บาท</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-12">
                                                <h4>แบบที่ลูกค้าจะพิมพ์</h4>
                                                <img src="./../img/modal/<?php echo $row->tra_modal_type ?>" width="50%" height="200px" alt="" srcset="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <?php if ($row->status_transale == '1') : ?>
                                            <button type="button" onclick="cancelTransale('<?php echo $row->id_transale; ?>')" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button>
                                            <button type="button" onclick="confilmTransale('<?php echo $row->id_transale; ?>')" class="btn btn-success">ยืนยันคำสั่งซื้อ</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>



                </div>


            </div>

        </div>
    </div>


    <?php include("inc/footer.php") ?>
    <!-- <script src="../js/u/shop.js"></script> -->

    <script>
        function cancelTransale(id_transale) {
            fetch("../api/a/cancelTransale.php", {
                method: "post",
                body: JSON.stringify({
                    id_transale: id_transale
                }),
            }).then(e => e.json()).then(resp => {
                if (resp) {
                    alert("บันทึกข้อมูลสำเร็จ")
                    location.reload();

                    return;
                }
                alert("บันทึกข้อมูลไม่สำเร็จ")
                location.reload();
            })
        }

        function confilmTransale(id_transale) {
            fetch("../api/a/confilmTransale.php", {
                method: "post",
                body: JSON.stringify({
                    id_transale: id_transale
                }),
            }).then(e => e.json()).then(resp => {
                if (resp) {
                    alert("บันทึกข้อมูลสำเร็จ")
                    location.reload();

                    return;
                }
                alert("บันทึกข้อมูลไม่สำเร็จ")
                location.reload();
            })
        }

        function updateNubTag(id_transale, tra_number_tag_ID) {

            let value = document.getElementById(tra_number_tag_ID).value;
            // console.log(value)



            fetch("../api/a/cupdateNubTagTransale.php", {
                method: "post",
                body: JSON.stringify({
                    id_transale: id_transale,
                    tra_number_tag: value
                }),
            }).then(e => e.json()).then(resp => {
                if (resp) {
                    alert("บันทึกข้อมูลสำเร็จ")
                    location.reload();
                    return;
                }
                alert("บันทึกข้อมูลไม่สำเร็จ")
                location.reload();
            })
        }
        $(document).ready(function() {


        });

        new DataTable('table');
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">



<head>
    <?php include("inc/head.php") ?>
</head>

<body class="">

    <?php include("inc/header.php") ?>

    <?php



    $rwRco = Database::squery("SELECT * FROM `paper_user` WHERE US_ID = '{$_SESSION["id"]}'", PDO::FETCH_OBJ, false);

    // print_r($rwRco);
    // exit;
    // $result_data = Database::query('', PDO::FETCH_ASSOC);
    ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">Account</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">หน้าหลัก</a>
                    <span class="breadcrumb-item active" aria-current="page">Account</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="shopify-grid">
        <div class="container py-5 my-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="h1-tab" data-bs-toggle="tab" data-bs-target="#h1-tab-pane" type="button" role="tab" aria-controls="h1-tab-pane" aria-selected="true">ข้อมูลส่วนตัว</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="h2-tab" data-bs-toggle="tab" data-bs-target="#h2-tab-pane" type="button" role="tab" aria-controls="h2-tab-pane" aria-selected="false">ข้อมูลจัดส่งสินค้า</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="h3-tab" data-bs-toggle="tab" data-bs-target="#h3-tab-pane" type="button" role="tab" aria-controls="h3-tab-pane" aria-selected="false">ประวัติคำส่งซื้อ</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="h1-tab-pane" role="tabpanel" aria-labelledby="h1-tab" tabindex="0">

                    <div class="card">
                        <div class="card-header">ข้อมูลส่วนตัว</div>
                        <div class="card-body">
                            <!-- ./api/signup.php -->
                            <form id="form1" action="javascript:;" method="POST" class="form-group mt-5">
                                <input type="hidden" name="US_ID" value="<?php echo $rwRco->US_ID ?>">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">ชื่อ</label>
                                        <input type="text" name="US_FNAME" value="<?php echo $rwRco->US_FNAME ?>" placeholder="กรุณากรอกชื่อ" class="form-control mb-3 p-4" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="">นามสกุล</label>
                                        <input type="text" name="US_LNAME" value="<?php echo $rwRco->US_LNAME ?>" placeholder="กรุณากรอกนามสกุล" class="form-control mb-3 p-4" required>

                                    </div>
                                    <div class="col-6">
                                        <label for="">เบอร์ติดต่อ</label>
                                        <input type="tel" name="US_PHONE" value="<?php echo $rwRco->US_PHONE ?>" placeholder="กรุณากรอกเบอร์" class="form-control mb-3 p-4" required>

                                    </div>
                                    <div class="col-6">
                                        <label for="">อีเมล</label>
                                        <input type="text" name="US_EMAIL" value="<?php echo $rwRco->US_EMAIL ?>" placeholder="Enter email address" class="form-control mb-3 p-4" value="user@user.com" required>

                                    </div>
                                    <div class="col-6">
                                        <label for="">รหัสผ่าน</label>
                                        <input type="password" id="inputPassword1" value="<?php echo $rwRco->US_PASSWORD ?>" placeholder="Enter password" name="US_PASSWORD" class="form-control mb-3 p-4" aria-describedby="passwordHelpBlock" value="user@user.com" required>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="d-grid my-3">
                                                <button type="submit" class="btn btn-dark btn-lg rounded-1">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <script>
                                document.getElementById('form1').addEventListener("submit", async (e) => {
                                    e.preventDefault();
                                    let ev = e.target;

                                    fetch("../api/u/setUserEditInfo.php", {
                                        method: "post",
                                        body: new FormData(ev),
                                    }).then(e => e.json()).then(resp => {
                                        if (resp) {
                                            alert("บันทึกข้อมูลสำเร็จ")
                                            location.reload();

                                            return;
                                        }
                                        alert("บันทึกข้อมูลไม่สำเร็จ")
                                        location.reload();
                                    })

                                });
                            </script>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="h2-tab-pane" role="tabpanel" aria-labelledby="h2-tab" tabindex="0">

                    <form id="form2" action="javascript:;" method="POST" class="form-group mt-5">
                        <input type="hidden" name="US_ID" value="<?php echo $rwRco->US_ID ?>">

                        <div class="row">
                            <div class="col-6">
                                <label for="">ที่อยู่จัดส่งสินค้า</label>
                                <textarea class="form-control" name="US_ADDESS" rows="4" required> <?php echo $rwRco->US_ADDESS ?></textarea>
                            </div>
                            <div class="col-6">
                                <label for="">จังหวัด</label>
                                <select name="provinces_code" id="provinces_code" class="form-control" required>
                                    <option value="">เลือก</option>
                                    <?php
                                    $sql = "SELECT * FROM `provinces`";
                                    foreach (Database::squery($sql, PDO::FETCH_OBJ, true) as $key => $item) : ?>
                                        <option <?php echo $rwRco->provinces_code == $item->code ? "selected" : "" ?> value="<?php echo "$item->code" ?>">
                                            <?php echo "$item->name_th" ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">อำเภอ</label>
                                <select name="district_code" required id="district_code" class="form-control">
                                    <option value="">เลือก</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">ตำบล</label>
                                <select name="subdistrict_code" required id="subdistrict_code" class="form-control">
                                    <option value="">เลือก</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-grid my-3">
                                        <button type="submit" class="btn btn-dark btn-lg rounded-1">บันทึก</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                    <script>
                        document.getElementById('form2').addEventListener("submit", async (e) => {
                            e.preventDefault();
                            let ev = e.target;

                            fetch("../api/u/setUserEditAddess.php", {
                                method: "post",
                                body: new FormData(ev),
                            }).then(e => e.json()).then(resp => {
                                if (resp) {
                                    alert("บันทึกข้อมูลสำเร็จ")
                                    location.reload();

                                    return;
                                }
                                alert("บันทึกข้อมูลไม่สำเร็จ")
                                location.reload();
                            })

                        });
                    </script>

                </div>
                <div class="tab-pane fade show active" id="h3-tab-pane" role="tabpanel" aria-labelledby="h3-tab" tabindex="0">

                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>ลำดับ</th>
                                <th>รหัสโค้ด</th>
                                <th>วันที่สั่งสินค้า</th>
                                <th>สถานะ</th>
                                <th>ชำระเงิน</th>
                                <th>เลขติดตาม</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_data = "SELECT * FROM `transale` WHERE US_ID = '{$rwRco->US_ID}' ORDER BY id_transale DESC ";
                            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                            <?php foreach ($result_data as $k => $row) :
                                $row = (object) $row;
                            ?>
                                <tr>
                                    <td><?php echo $k + 1 ?></td>
                                    <td>TRAN-<?php echo  $row->id_transale ?></td>
                                    <td><?php echo  date("d-m-Y", strtotime($row->date_transale)) ?></td>
                                    <td>
                                        <?php
                                        $stat = "";
                                        switch ($row->status_transale) {
                                            case '1':
                                                $stat = "<span class='badge rounded-pill text-bg-primary'>รอยืนยัน</span>";
                                                break;
                                            case '2':
                                                $stat = "<span class='badge rounded-pill text-bg-info'>ยืนยันคำสั่งซื้อ</span>";
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
                                        <button type="button" style="padding: 6px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transale-<?php echo  $row->id_transale ?>">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    <!-- Modal -->

                                </tr>



                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <?php

                    $sql_data = "SELECT * FROM `transale` WHERE US_ID = '{$rwRco->US_ID}'";
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
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <?php if ($row->status_transale == '1') : ?>
                                            <button type="button" onclick="cancelTransale('<?php echo $row->id_transale; ?>')" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button>
                                        <?php endif; ?>
                                        <?php if ($row->status_transale == '3') : ?>
                                            <button type="button" onclick="cSuccessTransale('<?php echo $row->id_transale; ?>')" class="btn btn-outline-success">ยืนยันรับสินค้า</button>
                                        <?php endif; ?>

                                        <a target="_blank" href="./print.php?ID=<?php echo $row->id_transale; ?>&t=a" class="btn  btn-dark">ใบเสร็จ</a>


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
            fetch("../api/u/cancelTransale.php", {
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

        function cSuccessTransale(id_transale) {
            fetch("../api/u/cSuccessTransale.php", {
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

        document.getElementById("provinces_code").addEventListener("change", async (e) => {
            e.preventDefault();
            let ev = e.target;

            fetch("../api/getDistrict.php", {
                method: "post",
                body: JSON.stringify({
                    key: ev.value
                }),
            }).then(e => e.json()).then(resp => {
                $("#district_code").html(``);
                let html = `<option value="">เลือก</option>`;
                let district_code = `<?php echo $rwRco->district_code ?>`;
                for (const item of resp) {

                    if (district_code == item.code) {
                        html += `<option selected value="${item.code}">${item.name_th}</option>`;

                    } else {
                        html += `<option value="${item.code}">${item.name_th}</option>`;
                    }
                }

                $("#district_code").html(html);

            })

        })

        document.getElementById("district_code").addEventListener("change", async (e) => {
            e.preventDefault();
            let ev = e.target;

            fetch("../api/getSubDistrict.php", {
                method: "post",
                body: JSON.stringify({
                    key: ev.value
                }),
            }).then(e => e.json()).then(resp => {
                $("#subdistrict_code").html(``);
                let html = `<option value="">เลือก</option>`;
                let subdistrict_code = `<?php echo $rwRco->subdistrict_code ?>`;

                for (const item of resp) {

                    if (district_code == item.code) {
                        html += `<option selected value="${item.code}">${item.name_th}</option>`;

                    } else {
                        html += `<option value="${item.code}">${item.name_th}</option>`;
                    }
                }
                $("#subdistrict_code").html(html);

            })

        })


        $(document).ready(function() {

            fetch("../api/getDistrict.php", {
                method: "post",
                body: JSON.stringify({
                    key: <?php echo $rwRco->provinces_code ?>
                }),
            }).then(e => e.json()).then(resp => {
                $("#district_code").html(``);
                let html = `<option value="">เลือก</option>`;
                let district_code = `<?php echo $rwRco->district_code ?>`;
                for (const item of resp) {

                    if (district_code == item.code) {
                        html += `<option selected value="${item.code}">${item.name_th}</option>`;
                    } else {
                        html += `<option value="${item.code}">${item.name_th}</option>`;
                    }
                }

                $("#district_code").html(html);

                fetch("../api/getSubDistrict.php", {
                    method: "post",
                    body: JSON.stringify({
                        key: <?php echo $rwRco->district_code ?>
                    }),
                }).then(e => e.json()).then(resp => {
                    $("#subdistrict_code").html(``);
                    let html = `<option value="">เลือก</option>`;
                    let subdistrict_code = `<?php echo $rwRco->subdistrict_code ?>`;

                    for (const item of resp) {

                        if (subdistrict_code == item.code) {
                            html += `<option selected value="${item.code}">${item.name_th}</option>`;
                        } else {
                            html += `<option value="${item.code}">${item.name_th}</option>`;
                        }
                    }

                    $("#subdistrict_code").html(html);
                })

            })
        });

        new DataTable('table');
    </script>
</body>

</html>
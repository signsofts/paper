<!DOCTYPE html>
<html lang="en">



<head>
    <?php include("inc/head.php") ?>
</head>

<body class="">

    <?php include("inc/header.php") ?>

    <?php



    $rwRco = Database::squery("SELECT * FROM `paper_ad_account` WHERE AD_ID = '{$_SESSION["id"]}'", PDO::FETCH_OBJ, false);

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
                    <button class="nav-link active" id="h1-tab" data-bs-toggle="tab" data-bs-target="#h1-tab-pane" type="button" role="tab" aria-controls="h1-tab-pane" aria-selected="true">ข้อมูลส่วนตัว</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  show active " id="h1-tab-pane" role="tabpanel" aria-labelledby="h1-tab" tabindex="0">

                    <div class="card">
                        <div class="card-header">ข้อมูลส่วนตัว</div>
                        <div class="card-body">
                            <!-- ./api/signup.php -->
                            <form id="form1" action="javascript:;" method="POST" class="form-group mt-5">
                                <input type="hidden" name="AD_ID" value="<?php echo $rwRco->AD_ID ?>">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">ชื่อ</label>
                                        <input type="text" name="AD_FNAME_TH" value="<?php echo $rwRco->AD_FNAME_TH ?>" placeholder="กรุณากรอกชื่อ" class="form-control mb-3 p-4" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="">นามสกุล</label>
                                        <input type="text" name="AD_LNAME_TH" value="<?php echo $rwRco->AD_LNAME_TH ?>" placeholder="กรุณากรอกนามสกุล" class="form-control mb-3 p-4" required>

                                    </div>

                                    <div class="col-6">
                                        <label for="">อีเมล</label>
                                        <input type="text" name="AD_EMAIL" value="<?php echo $rwRco->AD_EMAIL ?>" placeholder="Enter email address" class="form-control mb-3 p-4" value="user@user.com" required>

                                    </div>
                                    <div class="col-6">
                                        <label for="">รหัสผ่าน</label>
                                        <input type="password" id="inputPassword1" value="<?php echo $rwRco->AD_PASSWORD ?>" placeholder="Enter password" name="AD_PASSWORD" class="form-control mb-3 p-4" aria-describedby="passwordHelpBlock" value="user@user.com" required>

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

                                    fetch("../api/a/setUserEditInfo.php", {
                                        method: "post",
                                        body: new FormData(ev),
                                    }).then(e => e.json()).then(resp => {
                                        if (resp) {
                                            alert("บันทึกข้อมูลสำเร็จ")
                                            location.reload();

                                            return;
                                        }
                                        alert("บันทึกข้อมูลไม่สำเร็จxx ")
                                        location.reload();
                                    })

                                });
                            </script>
                        </div>
                    </div>

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
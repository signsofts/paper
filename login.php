<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("./head.php") ?>
</head>




<body class="">

    <?php include ("./header.php") ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">Sign In - Sign Up</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="./index.php">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">Sign In - Sign Up</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="login-tabs padding-large">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center border-dark-subtle mb-3" id="nav-tab"
                            role="tablist">
                            <button
                                class="nav-link mx-3 fs-3 border-bottom border-dark-subtle border-0 text-uppercase active"
                                id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button"
                                role="tab" aria-controls="nav-sign-in" aria-selected="true">Log In</button>
                            <button class="nav-link mx-3 fs-3 border-bottom border-dark-subtle border-0 text-uppercase"
                                id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button"
                                role="tab" aria-controls="nav-register" aria-selected="false" tabindex="-1">Sign
                                Up</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show " id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
                            <div class="col-lg-8 offset-lg-2 mt-5">

                                <p class="mb-0">Log - In</p>
                                <hr class="my-1">

                                <form id="form1" action="./api/login.php" method="POST" class="form-group flex-wrap ">
                                    <div class="form-input col-lg-12 my-4">

                                        <input type="text" id="exampleInputEmail1" name="US_EMAIL"
                                            placeholder="Enter email address" class="form-control mb-3 p-4"
                                            value="user@user.com">
                                        <input type="password" id="inputPassword1" placeholder="Enter password"
                                            name="US_PASSWORD" class="form-control mb-3 p-4"
                                            aria-describedby="passwordHelpBlock" value="user@user.com">


                                        <div class="d-grid my-3">
                                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Log In</button>
                                        </div>

                                    </div>
                                </form>

                            </div>

                        </div>
                        <div class="tab-pane fade " id="nav-register" role="tabpanel"
                            aria-labelledby="nav-register-tab">
                            <div class="col-lg-8 offset-lg-2 mt-5">

                                <p class="mb-0">Sign - Up</p>
                                <hr class="my-1">
                                <form id="form2" action="./api/signup.php" method="POST" class="form-group flex-wrap ">
                                    <div class="form-input col-lg-12 my-4">

                                        <label for="">ชื่อ</label>
                                        <input type="text" id="exampleInputEmail1" name="US_FNAME"
                                            placeholder="กรุณากรอกชื่อ" class="form-control mb-3 p-4" required>

                                        <label for="">นามสกุล</label>
                                        <input type="text" id="exampleInputEmail1" name="US_LNAME"
                                            placeholder="กรุณากรอกนามสกุล" class="form-control mb-3 p-4" required>
                                        <label for="">เบอร์ติดต่อ</label>
                                        <input type="tel"   id="exampleInputEmail1" name="US_PHONE"
                                            placeholder="กรุณากรอกเบอร์" class="form-control mb-3 p-4" required>

                                        <hr>

                                        <label for="">อีเมล</label>
                                        <input type="text" id="exampleInputEmail1" name="US_EMAIL" 
                                            placeholder="Enter email address" class="form-control mb-3 p-4"
                                            value="user@user.com" required>

                                        <label for="">รหัสผ่าน</label>
                                        <input type="password" id="inputPassword1" placeholder="Enter password"
                                            name="US_PASSWORD" class="form-control mb-3 p-4"
                                            aria-describedby="passwordHelpBlock" value="user@user.com" required>



                                        <label for="">ที่อยู่จัดส่งสินค้า</label>
                                        <textarea class="form-control" name="US_ADDESS" rows="4" required ></textarea>

                                        <label for="">จังหวัด</label>
                                        <select name="provinces_code" id="provinces_code" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <?php
                                            $sql = "SELECT * FROM `provinces`";
                                            foreach (Database::squery($sql, PDO::FETCH_OBJ, true) as $key => $item): ?>
                                                <option value="<?php echo "$item->code" ?>">
                                                    <?php echo "$item->name_th" ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label for="">อำเภอ</label>
                                        <select name="district_code" required id="district_code" class="form-control">
                                            <option value="">เลือก</option>
                                        </select>
                                        <label for="">ตำบล</label>
                                        <select name="subdistrict_code" required id="subdistrict_code" class="form-control">
                                            <option value="">เลือก</option>
                                        </select>

                                        <div class="d-grid my-3">
                                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Sign Up</button>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr style="margin-bottom: 200px ;">

    <?php include ("./footer.php") ?>
    <script>
        document.getElementById("provinces_code").addEventListener("change", async (e) => {
            e.preventDefault();
            let ev = e.target;

            fetch("./api/getDistrict.php", {
                method: "post",
                body: JSON.stringify({ key: ev.value }),
            }).then(e => e.json()).then(resp => {
                $("#district_code").html(``);
                let html = `<option value="">เลือก</option>`;

                for (const item of resp) {
                    html += `<option value="${item.code}">${item.name_th}</option>`;
                }



                $("#district_code").html(html);

            })

        })

        document.getElementById("district_code").addEventListener("change", async (e) => {
            e.preventDefault();
            let ev = e.target;

            fetch("./api/getSubDistrict.php", {
                method: "post",
                body: JSON.stringify({ key: ev.value }),
            }).then(e => e.json()).then(resp => {
                $("#subdistrict_code").html(``);
                let html = `<option value="">เลือก</option>`;
                for (const item of resp) {
                    html += `<option value="${item.code}">${item.name_th}</option>`;
                }
                $("#subdistrict_code").html(html);

            })

        })
    </script>
</body>

</html>
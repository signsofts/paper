<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("inc/head.php") ?>
</head>


<body class="">

    <?php include("inc/header.php") ?>

    <?php

    // print_r($uAuccotu);
    // exit(0);
    ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">Checkout</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">Checkout</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="shopify-cart checkout-wrap">
        <div class="container py-5 my-5">
            <form id="checout" enctype="multipart/form-data" class="form-group" action="javascript:; " method="post" aria-multiline="">
                <div class="row d-flex flex-wrap">
                    <div class="col-lg-6">
                        <h2 class="text-dark pb-3">รายละเอียด</h2>
                        <div class="billing-details">
                            <label for="fname">ชื่อ - นามสกุล</label>
                            <input type="text" class="form-control mt-2 mb-4 ps-3" disabled value="<?php echo $uAuccotu->US_FNAME . "  " . $uAuccotu->US_LNAME ?>">
                        </div>
                        <div class="billing-details">
                            <label for="fname">เบอร์ติดต่อ</label>
                            <input type="text" class="form-control mt-2 mb-4 ps-3" disabled value="<?php echo $uAuccotu->US_PHONE ?>">
                        </div>
                        <div class="billing-details">
                            <label for="fname">อีเมล</label>
                            <input type="text" class="form-control mt-2 mb-4 ps-3" disabled value="<?php echo $uAuccotu->US_EMAIL ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="text-dark pb-3">รายละเอียดที่จัดส่ง</h2>
                        <h1></h1>
                        <div class="billing-details">
                            <textarea disabled class="form-control pt-3 pb-3 ps-3 mt-2" placeholder="Notes about your order. Like special notes for delivery."><?php echo "$uAuccotu->US_ADDESS ตำบล $uAuccotu->dsname อำเภอ $uAuccotu->dname จังหวัด $uAuccotu->pname  $uAuccotu->zip_code "   ?>
                                
                            </textarea>
                        </div>
                        <div class="your-order mt-5">
                            <h2 class="display-7 text-dark pb-3">ยอดรวมรถเข็น</h2>
                            <div class="total-price">
                                <table cellspacing="0" class="table">
                                    <tbody>

                                        <tr class="order-total border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Total</th>
                                            <td data-title="Total">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol"><?php echo $_GET["totle"] ?></span> บาท </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="list-group mt-5 mb-3">
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input type="hidden" id="fileUploadBase641" name="img641" value="">
                                        <input id="fileUpload1" type="file" required accept=".png,.jpge" name="fileUpload">
                                        <span>
                                            <strong class="text-uppercase">แบบที่ลูกค้าจะพิมพ์</strong>
                                        </span>
                                    </label>
                                    <br>
                                    <br>
                                    <br>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio" required name="type_play" id="type_play2" value="1" onclick="type_playClick(this)">
                                        <span>
                                            <strong class="text-uppercase">แนบสลิปโอนเงิน</strong>
                                            <small class="d-block text-body-secondary"></small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input type="hidden" id="fileUploadBase64" name="img64" value="">
                                        <input style="display: none;" id="fileUpload" type="file" required accept=".png,.jpge" name="fileUpload">


                                        <span>
                                            <strong class="text-uppercase">อัพโหลดสลิป</strong>

                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio" required name="type_play" id="type_play3" value="0" onclick="type_playClick(this)">
                                        <span>
                                            <strong class="text-uppercase">เก็บเงินปลายทาง</strong>
                                            <small class="d-block text-body-secondary">Pay with cash upon
                                                delivery.</small>
                                        </span>
                                    </label>






                                </div>
                                <button type="submit" name="submit" class="btn btn-dark btn-lg rounded-1 w-100">สั่งซื้อสินค้า</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <?php include("inc/footer.php") ?>
    <!-- <script src="../js/u/shop.js"></script> -->
    <script src="../js/u/checkout.js"></script>

    <script>
        document.getElementById("fileUpload").addEventListener("change", e => {

            $("#fileUploadBase64").val('');
            e.preventDefault();
            let ev = e.target;
            if (!ev.files || !ev.files[0]) return;

            const FR = new FileReader();

            FR.addEventListener("load", function(evt) {
                // console.log()
                $("#fileUploadBase64").val(evt.target.result);
            });

            FR.readAsDataURL(ev.files[0]);
        })
        document.getElementById("fileUpload1").addEventListener("change", e => {

            $("#fileUploadBase641").val('');
            e.preventDefault();
            let ev = e.target;
            if (!ev.files || !ev.files[0]) return;

            const FR = new FileReader();

            FR.addEventListener("load", function(evt) {
                // console.log()
                $("#fileUploadBase641").val(evt.target.result);
            });

            FR.readAsDataURL(ev.files[0]);
        })
    </script>

    <script>
        const type_playClick = (ev) => {
            if (ev.value == 1) {
                $("#fileUpload").show();
                // $(selector).after(content);
                $("#fileUpload").prop('disabled', false);
                // $("#fileUploadBase64").val('');
            } else {
                // $("#fileUploadBase64").val('');
                $("#fileUpload").hide();
                $("#fileUpload").prop('disabled', true);

            }
        }
    </script>

</body>

</html>
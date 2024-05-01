<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("inc/head.php") ?>
</head>


<?php
$sql_data = "SELECT * FROM products as pro
            INNER JOIN typepro as ty ON ty.id_typepro = pro.id_typepro
            WHERE pro.id_products =  " . $_GET['id_products']; //คำสั่งแสดง record ต่อหนึ่งหน้า $pagesize = ต้องการกี่ record ต่อ
$result = Database::query($sql_data, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

?>


<body class="">

    <?php include("inc/header.php") ?>


    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0"><?php echo $result->name_products ?></h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">shop</span>
                </nav>
            </div>
        </div>
    </section>

    <section id="selling-product">
        <div class="container my-md-5 py-5">
            <div class="row g-md-5">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- product-large-slider -->
                            <div class="swiper product-large-slider swiper-fade swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
                                <div class="swiper-wrapper" id="swiper-wrapper-1f4ec577182b015e" aria-live="polite">
                                    <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 624px; opacity: 1; transform: translate3d(0px, 0px, 0px);" role="group" aria-label="1 / 4">
                                        <img src="../img/pro/<?php echo $result->image_pro ?>" class="img-fluid">
                                    </div>


                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-6 mt-5 ">
                    <div class="product-info">
                        <div class="element-header">
                            <h2 itemprop="name" class="display-6"><?php echo $result->name_products ?></h2>
                            <div class="rating-container d-flex gap-0 align-items-center">

                            </div>
                        </div>
                        <div class="product-price pt-3 pb-3">
                            <strong class="text-primary display-6 fw-bold"><?php echo $result->price_unit ?> บาท/ลัง</strong>
                            <p> จำนวน <?php echo $result->pro_max ?> ชิ้น/ลัง</p>
                        </div>
                        <h5 class="text-primary">ราคาเฉลี่ย <?php echo $result->price_mini ?> บาท/ชิ้น</h5>
                        <div class="cart-wrap">
                            <div class="product-quantity pt-2">
                                <div class="stock-number text-dark"><em> คงเหลือ <?php echo $result->num_stock ?> ลัง</em></div>
                                <div class="stock-button-wrap">
                                    <div class="input-group product-qty align-items-center w-25">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-light btn-number" data-type="minus">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#minus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity" class="form-control input-number text-center p-2 mx-1" value="1">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-light btn-number" data-type="plus" data-field="">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap pt-4">
                                        <a href="javascript:addCartProduct('<?php echo $result->id_products ?>','<?php echo $result->name_products ?>','<?php echo $result->price_unit ?>',document.getElementById(`quantity`).value,`<?php echo $result->image_pro ?>`);" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-info-tabs py-md-5">
        <div class="container">
            <div class="row">
                <div class="d-flex flex-column flex-md-row align-items-start gap-5">
                    <div class="nav flex-row flex-wrap flex-md-column nav-pills me-3 col-lg-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link fs-5 mb-2 text-start active" id="v-pills-description-tab" data-bs-toggle="pill" data-bs-target="#v-pills-description" type="button" role="tab" aria-controls="v-pills-description" aria-selected="true">ราละเอียด</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab" tabindex="0">
                            <h2>ราละเอียด</h2>
                            <div>
                                <?php echo $result->pro_de ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        // const queryString = window.location.search;
    </script>
    <?php include("inc/footer.php") ?>

</body>
<html lang="en">

<head>
    <?php include("inc/head.php") ?>
</head>

<body class="">
    <?php include("inc/header.php") ?>

    <style>
        .bgs {
            /* The image used */
            background-image: url("../img/banner-img.jpg");

            /* Full height */
            height: 100%;
            /* Center and scale the image nicely */
            background-position: right;

            background-repeat: no-repeat;
            /* background-size: cover; */
        }
    </style>

    <section id="banner" class="bgs" style="height: 50%;">

    </section>

    <section id="foodies" class="my-5">
        <div class="container my-5 py-5">
            <h2 class="display-3 fw-normal">SHOP</h2>

            <div>
                <a href="./shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    shop now
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>

            <div class="section-header d-md-flex justify-content-between align-items-center mt-3">
                <div class="mb-4 mb-md-0">
                    <p class="m-0">
                        <button class="filter-button me-4  active" data-filter="*">ALL</button>
                        <?php
                        $sql = "SELECT * FROM `typepro` WHERE TY_STATUS IS NULL ";
                        foreach (Database::squery($sql, PDO::FETCH_OBJ, true) as $key => $item) : ?>
                            <button class="filter-button me-4 " data-filter=".<?php echo "PROTYPE_" . $item->id_typepro ?>"><?php echo $item->name_typepro ?></button>
                        <?php endforeach; ?>
                    </p>
                </div>
            </div>

            <div class="isotope-container row" style="position: relative; height: 1053.06px;">
                <?php
                $sql_data = "SELECT * FROM products as pro
                                                INNER JOIN typepro as ty ON ty.id_typepro = pro.id_typepro
                                                WHERE pro.status_products = 1 "; //คำสั่งแสดง record ต่อหนึ่งหน้า $pagesize = ต้องการกี่ record ต่อ
                $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                <?php foreach ($result_data as $row) :
                    $row = (object) $row;
                ?>
                    <div class="item <?php echo "PROTYPE_" . $row->id_typepro ?> col-md-4 col-lg-3 my-4" style="position: absolute; left: 0px; top: 0px;">
                        <div class="card position-relative">
                            <!-- single-product.php?id_products=<?php echo $row->id_products ?> -->
                            <as href="javascript:;"><img src="../img/pro/<?php echo $row->image_pro ?>" class="img-fluid rounded-4" alt="image"></as>
                            <div class="card-body p-0">
                                <div class=" d-flex justify-content-between ">
                                    <h5 class="secondary-font text-dark">
                                        <?php echo $row->name_products ?>
                                    </h5>
                                    <h5 class="secondary-font text-primary">
                                        <?php echo $row->num_stock ?> ชิ้น
                                    </h5>
                                </div>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary"><?php echo $row->price_unit ?> บาท/ชิ้น</h3>
                                    <div class=" d-flex justify-content-between ">
                                        จำนวนชิ้น
                                        <input id="input-<?php echo $row->id_products ?>" type="number" class="w-25" value="1" min="1">
                                    </div>
                                    <div class="d-flex flex-wrap mt-3">
                                        <a href="javascript:addCartProduct('<?php echo $row->id_products ?>','<?php echo $row->name_products ?>','<?php echo $row->price_unit ?>',document.getElementById(`input-<?php echo $row->id_products ?>`).value,`<?php echo $row->image_pro ?>`);" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <?php include("inc/footer.php") ?>


    


</body>

</html>
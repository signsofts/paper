<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("inc/head.php") ?>
</head>


<body class="">

    <?php include("inc/header.php") ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">รายการสินค้า</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">หน้าหลัก</a>
                    <span class="breadcrumb-item active" aria-current="page">รายการสินค้า</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="shopify-grid">
        <div class="container py-5 my-5">
            <div class="row flex-md-row-reverse g-md-5 mb-5">
                <aside class="col-md-3 mt-5">
                    <div class="sidebar">
                        <div class="widget-menu">
                            <div class="widget-search-bar">
                                <div class="search-bar border rounded-2 border-dark-subtle pe-3">
                                    <form id="search-form" class="text-center d-flex align-items-center" action="./shop.php" method="get">
                                        <input type="text" class="form-control border-0 bg-transparent" id="ssname" name="name" placeholder="ค้นหาสินค้า" onchange="onchangeKey(this)" value="<?php echo isset($_GET["name"]) ? $_GET["name"] : "" ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z">
                                            </path>
                                        </svg>
                                    </form>

                                    <script>
                                        const onchangeKey = (ev) => {
                                            // document.getElementById('search-form').submit();
                                            search_name("ssname")
                                            // search_type(ev.value)
                                        }
                                        document.addEventListener("keydown", function(event) {
                                            if (event.key === "Enter") {
                                                document.getElementById('search-form').submit();
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="widget-product-categories pt-5">
                            <h4 class="widget-title">ประเภท</h4>
                            <ul class="product-categories sidebar-list list-unstyled  pl-3" style="    margin-left: 15px;">
                                <li class="cat-item ml-4">
                                    <a href="javascript:search_type('')"> &nbsp;&nbsp; ทั้งหมด</a>
                                </li>

                                <?php
                                $sql = "SELECT * FROM `typepro` WHERE TY_STATUS IS NULL ";
                                foreach (Database::squery($sql, PDO::FETCH_OBJ, true) as $key => $item) : ?>
                                    <li class="cat-item ">
                                        <a href="javascript:search_type('<?php echo $item->id_typepro ?>')" class="nav-link"> &nbsp;&nbsp;
                                            <?php echo $item->name_typepro ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>


                            </ul>
                        </div>

                    </div>
                </aside>
                <main class="col-md-9">
                    <div class="filter-shop d-md-flex justify-content-between align-items-center">
                        <div class="showing-product">
                            <select id="select_limit" name="select_limit" class="form-control p-3" style="padding-right : 1.25rem" onChange="select_sort_by(this);">
                                <option value="&amp;limit=10" <?php echo isset($_GET["limit"]) && $_GET["limit"] == 10
                                                                    ? 'selected="selected "' : " " ?>>10</option>
                                <option value="&amp;limit=25" <?php echo isset($_GET["limit"]) && $_GET["limit"] == 25
                                                                    ? 'selected="selected "' : " " ?>>25</option>
                                <option value="&amp;limit=50" <?php echo isset($_GET["limit"]) && $_GET["limit"] == 50
                                                                    ? 'selected="selected "' : " " ?>>50</option>
                                <option value="&amp;limit=75" <?php echo isset($_GET["limit"]) && $_GET["limit"] == 75
                                                                    ? 'selected="selected "' : " " ?>>75</option>
                                <option value="&amp;limit=100" <?php echo isset($_GET["limit"]) && $_GET["limit"] == 100
                                                                    ? 'selected="selected "' : " " ?>>100</option>
                            </select>
                        </div>
                        <div class="sort-by">
                            <select class="filter-categories border-0 m-0" onChange="select_sort_by(this);">
                                <!-- <option value="&amp;sort=id_productsr&amp;order=ASC" <?php echo isset($_GET["sort"]) && $_GET["sort"] == 'id_productsr' && isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected="selected "' : " " ?>>Default</option> -->
                                <option value="&amp;sort=name_products&amp;order=ASC" <?php echo isset($_GET["sort"]) &&
                                                                                            $_GET["sort"] == 'name_products' && isset($_GET['order']) && $_GET['order'] == 'ASC'
                                                                                            ? 'selected="selected "' : " " ?>>ชื่อ (A - Z)</option>
                                <option value="&amp;sort=name_products&amp;order=DESC" <?php echo isset($_GET["sort"])
                                                                                            && $_GET["sort"] == 'name_products' && isset($_GET['order']) && $_GET['order'] == 'DESC'
                                                                                            ? 'selected="selected "' : " " ?>>ชื่อ (Z - A)
                                </option>
                                <option value="&amp;sort=price_unit&amp;order=ASC" <?php echo isset($_GET["sort"]) &&
                                                                                        $_GET["sort"] == 'price_unit' && isset($_GET['order']) && $_GET['order'] == 'ASC'
                                                                                        ? 'selected="selected "' : " " ?>>ราคา (ต่ำ &gt; สูง)</option>
                                <option value="&amp;sort=price_unit&amp;order=DESC" <?php echo isset($_GET["sort"]) &&
                                                                                        $_GET["sort"] == 'price_unit' && isset($_GET['order']) && $_GET['order'] == 'DESC'
                                                                                        ? 'selected="selected "' : " " ?>>ราคา (สูง &gt; ต่ำ)
                                </option>
                            </select>
                        </div>
                        <button id="btn_reset" type="button" class="btn btn-sm btn-dark p-1   " onclick="location.assign('<?php echo $_SERVER['PHP_SELF'] ?>');">คืนค่าเริ่มต้น</button>

                    </div>

                    <div class="product-grid row ">
                        <?php
                        $page = null;
                        $start = 0; // ค่าของ record โดย page1 $startต้อง=0, page2 $startต้อง=3,page3 $startต้อง=6

                        $pagesize = isset($_GET['limit']) ? $_GET['limit'] : 10; //จำนวน record ที่ต้องการแสดงในหนึ่งหน้า
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_products';
                        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                        $type = isset($_GET['type']) ? $_GET['type'] : '%%';
                        $name = isset($_GET['name']) ? $_GET['name'] : '%%';


                        $sql_count = "SELECT *  FROM `products` as pro 
                                                 WHERE id_typepro LIKE '%$type%'
                                                    AND name_products LIKE '%$name%'
                                                    AND id_products NOT IN (SELECT id_products FROM products WHERE status_products = 0) ";

                        $sql_data = "SELECT * FROM products as pro
                                                INNER JOIN typepro as ty ON ty.id_typepro = pro.id_typepro
                                                WHERE pro.id_typepro LIKE '%$type%' 
                                                AND name_products LIKE '%$name%'  
                                                AND id_products NOT IN (SELECT id_products FROM products WHERE status_products = 0 )   
                                    ORDER BY pro.$sort  $order LIMIT $start,$pagesize"; //คำสั่งแสดง record ต่อหนึ่งหน้า $pagesize = ต้องการกี่ record ต่อ

                        $result_count = Database::query($sql_count, PDO::FETCH_ASSOC); //เก็บข้อมูลไว้ใน $result
                        $num_rowsx = $result_count->rowCount(); //ใช้คำสั่ง mysql_num_rows เพื่อหาจำนวน record ทั้งหมด
                        $totalpage = ceil($num_rowsx / $pagesize);

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            $start = ($page - 1) * $pagesize; //นี้เป็นสูตรการคำนวนครับ
                            // 2 -1 * 50
                            if ($num_rowsx < $start) {
                                $start = 0;
                            }
                        } else {
                            $page = 0;
                            $start = 0;
                        }

                        $result_data = null;
                        $num_rows = null;

                        $result_data = Database::query($sql_data, PDO::FETCH_ASSOC);
                        $num_rows = $result_data->rowCount();
                        ?>

                        <?php foreach ($result_data as $row) :
                            $row = (object) $row;
                        ?>
                            <div class="col-12 col-sm-6 col-md-4 my-4">
                                <div class="card position-relative">
                                    <a href="single-product.php?id_products=<?php echo $row->id_products ?>">
                                        <img src="../img/pro/<?php echo $row->image_pro ?>" class="img-fluid rounded-5" alt="image" style="width: 100%; height: 200px; ">
                                    </a>
                                    <div class="card-body p-2 pt-3">
                                        <div class="card-text">
                                            <div class=" d-flex justify-content-between ">
                                                <h5 class="secondary-font text-dark">
                                                    <?php echo $row->name_products ?>
                                                </h5>
                                                <h5 class="secondary-font text-primary">
                                                    <?php echo $row->num_stock ?> ลัง
                                                </h5>
                                            </div>
                                            <div class=" d-flex justify-content-between ">

                                                <h5 class="secondary-font text-primary">
                                                    <?php echo $row->price_unit ?> บาท/ลัง
                                                </h5>
                                            </div>
                                            <div class=" d-flex justify-content-between ">
                                                จำนวนลัง
                                                <input id="input-<?php echo $row->id_products ?>" type="number" class="w-25" value="1" min="1">
                                            </div>

                                            <div class="d-flex flex-wrap mt-3">
                                                <a href="javascript:addCartProduct('<?php echo $row->id_products ?>','<?php echo $row->name_products ?>','<?php echo $row->price_unit ?>',document.getElementById(`input-<?php echo $row->id_products ?>`).value,`<?php echo $row->image_pro ?>`);" class="btn-cart me-3 px-4 pt-3 pb-3">
                                                    <h5 class="text-uppercase m-0">เพิ่มสินค้า</h5>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- <hr> -->
                    <!-- / product-grid -->

                    <?php if ($num_rowsx != 0) : ?>
                        <!-- <div class="row"> -->
                        <!-- <div class="col-md-4 col-sm-4 items-info"> รายการที่
                                <?php echo $num_rowsx == 0 ? 0 : $start + 1; ?> ถึง
                                <?php echo $start + $pagesize > $num_rowsx ? $num_rowsx : $start + $pagesize; ?> of
                                <?php echo $num_rowsx ?> รายการ
                            </div> -->


                        <nav class="navigation paging-navigation text-center mt-5" role="navigation">

                            <div class="pagination loop-pagination d-flex justify-content-center align-items-center">
                                <?php
                                if ($page > 1) //ถ้า ค่า page มากกว่า 1 แสดงปุ่ม ย้อนกลับ Previuos
                                {
                                    $pg = $page - 1;

                                    echo "
                                        <a href='javascript:new_page($pg);' class='pagination-arrow d-flex align-items-center mx-3'>
                                            <iconify-icon icon='ic:baseline-keyboard-arrow-left'
                                                class='pagination-arrow fs-1'></iconify-icon>
                                        </a>
                                    ";
                                }
                                ?>

                                <?php

                                for ($i = 1; $i <= $totalpage; $i++) :

                                    if (isset($_GET['page']) && $_GET['page'] == $i) {
                                        echo "<span aria-current='page' class='page-numbers mt-2 fs-3 mx-3 current'>$i</span>";
                                    } else if (!isset($_GET['page']) && $i == 1) {
                                        echo "<span aria-current='page' class='page-numbers mt-2 fs-3 mx-3 current'>1</span>";
                                    } else {
                                        echo "<a class='page-numbers mt-2 fs-3 mx-3' href='javascript:new_page($i);'>$i</a>";
                                    }
                                // $page++;
                                endfor;

                                //next
                                if ($page < $totalpage && $page != 0) //ถ้า ค่า page น้อยกว่า page ทั้งหมด(page ท้ายสุด) แสดงปุ่ม  Next
                                {
                                    $pg = $page + 1;
                                    //echo "<a href='news.php?page=$pg'>Previuos</a>"; //ส่งค่า page ที่ลดลง 1 เมื่อกดปุ่ม next
                                    echo "
                                        <a href='javascript:new_page($pg);' class='pagination-arrow d-flex align-items-center mx-3'>
                                            <iconify-icon icon='ic:baseline-keyboard-arrow-right'
                                                class='pagination-arrow fs-1'></iconify-icon>
                                        </a>";
                                }

                                ?>
                            </div>
                        </nav>

                        <!-- </div> -->
                    <?php else : ?>
                        <div class="row">
                            ไม่พบรายการที่ค้นหา
                        </div>
                    <?php endif; ?>



                </main>

            </div>
        </div>
    </div>


    <?php include("inc/footer.php") ?>
    <script src="../js/u/shop.js"></script>
</body>

</html>
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
                <h2 class="display-1 mt-3 mb-0">ตะกร้าสินค้า</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">ตะกร้าสินค้า</span>
                </nav>
            </div>
        </div>
    </section>

    <section id="cart" class="my-5 py-5">
        <div class="container">
            <div class="row g-md-5">
                <div class="col-md-8 pe-md-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="card-title text-uppercase">สินค้า</th>
                                <th scope="col" class="card-title text-uppercase">จำนวน</th>
                                <th scope="col" class="card-title text-uppercase">ราคา/ลัง</th>
                                <th scope="col" class="card-title text-uppercase">ราคารวม</th>
                                <th scope="col" class="card-title text-uppercase"></th>
                            </tr>
                        </thead>
                        <tbody id="cart-tbody" >
                           

                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="cart-totals">
                        <h2 class="pb-4">ราคารวม</h2>
                        <div class="total-price pb-4">
                            <table cellspacing="0" class="table text-uppercase">
                                <tbody>
                                    <tr class="order-total pt-2 pb-2 border-bottom">
                                        <th  >Total</th>
                                        <td data-title="Total">
                                            <span id="price-amount" class="price-amount amount text-dark ps-5">
                                                
                                            </span>
                                             บาท 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button-wrap row g-2">
                           
                            <div class="col-md-12"><a id="hrefid" href="#"
                                    class="btn btn-primary p-3 text-uppercase rounded-1 w-100">สั่งซื้อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("inc/footer.php") ?>
    <!-- <script src="../js/u/shop.js"></script> -->
    <script src="../js/u/cart.js"></script>
</body>

</html>
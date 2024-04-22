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
                <h2 class="display-1 mt-3 mb-0">ประเภทสินค้า</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="#">หน้าหลัก</a>
                    <span class="breadcrumb-item active" aria-current="page">ประเภทสินค้า</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="shopify-grid">
        <div class="container py-5 my-5">
            <div class="row">
                <div class="col-12">
                    <button id="btn_addproduct" type="button" data-bs-toggle="modal" data-bs-target="#modalAddProduct" class="btn btn-lg btn-primary p-1">เพิ่มประเภท</button>
                </div>
            </div>

            <table class="table table-bordered w-100">
                <thead>
                    <tr class="table-info">
                        <th>ลำดับ</th>
                        <th>ชื่อประเภทสินค้า</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql_data = "SELECT * FROM `typepro`
                            WHERE TY_STATUS IS NULL";
                    $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
                    <?php foreach ($result_data as $k => $row) :
                        $row = (object) $row;
                    ?>
                        <tr>
                            <td><?php echo $k + 1 ?></td>
                            <td><?php echo $row->name_typepro ?></td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#edit-<?php echo $row->id_typepro ?>" href="javascript:;" class="btn btn-sm btn-info">
                                    <h5 class="text-uppercase m-0">แก้ไข</h5>
                                </a>
                            </td>

                        </tr>



                    <?php endforeach; ?>


                </tbody>
            </table>

            <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="formAddProductType" action="javascript:;" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAddProductLabel">เพิ่มประเภทสินค้า</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ชื่อประเภทสินค้า</label>
                                            <input name="name_typepro" type="text" class="form-control" placeholder="ระบุชื่อประเภทสินค้า" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-lg btn-primary p-1">เพิ่ม</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <?php

            $sql_data = "SELECT * FROM `typepro`
            WHERE TY_STATUS IS NULL";
            $result_data = Database::query($sql_data, PDO::FETCH_ASSOC); ?>
            <?php foreach ($result_data as $k => $row) :
                $row = (object) $row;
            ?>

                <div class="modal fade" id="edit-<?php echo $row->id_typepro ?>" tabindex="-1" aria-labelledby="edit-<?php echo $row->id_typepro ?>Label" aria-hidden="true">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content">
                            <form id="formEditProductType-<?php echo $row->id_typepro ?>" action="javascript:;" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_typepro" value="<?php echo $row->id_typepro ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAddProductLabel">แก้ไขประเภทสินค้า</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">ชื่อสินค้า</label>
                                                <input name="name_typepro" type="text" class="form-control" placeholder="ระบุชื่อสินค้า" required value="<?php echo $row->name_typepro ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="Delete_prodType('<?php echo $row->id_typepro ?>')" class="btn btn-lg btn-danger p-1">ลบ</button>
                                    <button type="submit" class="btn btn-lg btn-primary p-1">แก้ไข</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById("formEditProductType-<?php echo $row->id_typepro ?>").addEventListener("submit", e => {
                        e.preventDefault();
                        let ev = e.target;

                        const form = new FormData(ev);
                        // form.append("cart", localStorage.getItem('product'))/

                        fetch("../api/a/formEditProductType.php", {
                            method: "post",
                            body: form,
                        }).then(e => e.json()).then(resp => {
                            if (resp.error == false) {
                                alert("แก้ไขสินค้าสำเร็จ");

                                location.reload();
                            } else {
                                alert(resp.error);
                            }
                        })
                    });
                </script>

            <?php endforeach; ?>

        </div>
    </div>


    <?php include("inc/footer.php") ?>
    <!-- <script src="../js/u/shop.js"></script> -->

    <script>
        document.getElementById("formAddProductType").addEventListener("submit", e => {
            e.preventDefault();
            let ev = e.target;

            const form = new FormData(ev);
            // form.append("cart", localStorage.getItem('product'))/

            fetch("../api/a/formAddProductType.php", {
                method: "post",
                body: form,
            }).then(e => e.json()).then(resp => {
                if (resp.error == false) {
                    alert("เพิ่มประเภทสินค้าสำเร็จ");
                    location.reload();
                } else {
                    alert(resp.error);
                }
            })
        });

        
        const Delete_prodType = (id_typepro) => {
            fetch("../api/a/formDeleteProductType.php", {
                method: "post",
                body: JSON.stringify({
                    id_typepro: id_typepro
                }),
            }).then(e => e.json()).then(resp => {
                if (resp.error == false) {
                    alert("ลบสินค้าสำเร็จ");
                    location.reload();
                } else {
                    alert(resp.error);
                }
            })
        }

        new DataTable('table');
    </script>
</body>

</html>
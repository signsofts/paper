<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน</title>

    <link href="../script/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../script/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../script/assets/plugins/jquery.min.js" type="text/javascript"></script>

    <?php
    include_once('../config/connectdb.php');

    ?>

    <style>
        body {
            background: rgb(204, 204, 204);
            /* margin: 30px; */
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            margin-top: 0.5cm;
            padding: 10px;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }

        page[size="A4"] {
            width: 21cm;
            /* height: 29.7cm; */
        }

        /* 
        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        } */

        @media print {

            body,
            page {
                background: white;
                margin: 0;
            }

            page[size="A4"] {
                width: 21cm;
                box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            }

            #btn-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <?php
    // $date = $_GET["date"] == 'null' ? null : $_GET["date"];


    ?>
    <page size="A4">
        <button id="btn-print" class="btn btn-sm btn-primary" style="display:block" onclick="pritns()">พิมพ์</button>
        <table id="example" class="display table   table-borderless  " style="width:100%">
            <thead>
                <tr>
                    <th>คำสั่งซื้อ</th>
                    <th>วันที่</th>
                    <th>ชื่อลูกค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php $sump = 0; ?>
                <?php

                $sql_data = "SELECT * , provinces.name_th AS pname , district.name_th AS dname , subdistrict.name_th AS dsname
                FROM `transale` 
                      INNER  JOIN paper_user ON paper_user.US_ID = transale.US_ID
                      INNER JOIN provinces ON provinces.code = paper_user.provinces_code 
                      INNER JOIN district ON district.code = paper_user.district_code 
                      INNER JOIN subdistrict ON subdistrict.code = paper_user.subdistrict_code
                WHERE status_transale = '4'";

                // print_r(Database::squery($sql_data, PDO::FETCH_OBJ, true));
                // exit;

                foreach (Database::squery($sql_data, PDO::FETCH_OBJ, true) as $ke => $it) : ?>

                    <?php

                    $sql = "SELECT * FROM `transalede`
                            LEFT JOIN products ON  transalede.id_products= products.id_products
                            LEFT JOIN typepro ON  products.id_typepro= typepro.id_typepro
                            WHERE transalede.id_transale = '$it->id_transale'";
                    ?>
                    <?php foreach (Database::squery($sql, PDO::FETCH_OBJ, true) as $key => $item) : ?>
                        <tr>
                            <td>
                                <?php echo "TRAN-" . $item->id_transale ?>
                            </td>
                            <td>
                                <?php echo date("d-m-Y", strtotime($it->date_transale)) ?>
                            </td>
                            <td>
                                <?php echo $it->US_FNAME . " " . $it->US_LNAME ?>
                            </td>
                            <td>
                                <?php echo $item->name_products ?>
                            </td>
                            <td>
                                <?php echo $item->num_item ?> ชิ้น
                            </td>
                            <td>
                                <?php $sump += $item->num_item * $item->price_tran; ?>
                                <?php echo $item->num_item * $item->price_tran; ?> บาท
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endforeach; ?>

                <tr style="background-color: #0001;">
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                        <u>
                            <h5>ราคารวม</h5>
                        </u>
                    </td>
                    <td>
                    </td>
                    <td>
                        <u>
                            <h5>
                                <?php echo $sump ?> บาท
                            </h5>
                        </u>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>คำสั่งซื้อ</th>
                    <th>วันที่</th>
                    <th>ชื่อลูกค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                </tr>
            </tfoot>
        </table>
    </page>

    <script>
        const pritns = () => {
            $("#btn-print").hide();
            window.print();
            $("#btn-print").show();
        }
    </script>

</body>

</html>
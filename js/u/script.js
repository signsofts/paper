const queryString = window.location.search;

function search_type(object) {
    if (queryString.includes("?")) {
        location.assign(window.location.href + "&type=" + object);
    } else {
        location.assign(window.location.href + "?type=" + object);
    }
}

function search_name(object) {
    var name = $("#" + object).val();

    if (queryString.includes("?")) {
        location.assign(window.location.href + "&name=" + name);
    } else {
        location.assign(window.location.href + "?name=" + name);
    }
}

// function select_provinces(object) {
//     var name = $("#" + object).val();
//     if (queryString.includes("?")) {
//         location.assign(window.location.href + "&provinces=" + name);
//     } else {
//         location.assign(window.location.href + "?provinces=" + name);
//     }
// }

function select_sort_by(object) {
    var count = 0;
    if (queryString.includes("?")) {
        location.assign(window.location.href + object.value);
    } else {
        location.assign(window.location.href + "?" + object.value);
    }
}

function select_limit(object) {
    if (queryString.includes("?")) {
        location.assign(window.location.href + object.value);
    } else {
        location.assign(window.location.href + "?" + object.value);
    }
}

function new_page(object) {
    if (queryString.includes("?")) {
        location.assign(window.location.href + "&page=" + object);
    } else {
        location.assign(window.location.href + "?page=" + object);
    }
}



function addCartProduct(id_products, name_products, price_unit, item, image_pro) {

    // console.log(localStorage.getItem('product'));

    let temp = [];
    let temps = [];

    let product = {
        id_products: id_products,
        name_products: name_products,
        price_unit: price_unit,
        item: parseInt(item),
        image_pro: image_pro
    }

    // console.log(product)



    if (localStorage.getItem('product') == null) {

        temp.push(product);

        localStorage.setItem('product', JSON.stringify(temp))
    }

    let rco = JSON.parse(localStorage.getItem('product'));

    let checkItem = false;
    rco.forEach((i, k) => {
        if (i.id_products == id_products) {
            checkItem = true;
        }
    });

    if (checkItem) {
        rco.forEach((i, k) => {
            if (i.id_products == id_products) {
                i.item = parseInt(i.item) + parseInt(item);
            }
            temps.push(i);
        });

        // localStorage.setItem('product', JSON.stringify(temps))
    } else {
        temps.push(product);
    }

    localStorage.setItem('product', JSON.stringify(temps))


    // console.log(localStorage.getItem('product'));
    updateCart();

    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "เพิ่มสินค้าสำเร็จ",
        showConfirmButton: false,
        timer: 1000
    });

}

function updateCart() {

    let html = ``;

    let rco = JSON.parse(localStorage.getItem('product'));

    if (!rco) {
        $("#cartSum").html(0 + " รายการ")
        $("#sumMainProduct").html(0)
        $("#sumMainProduct1").html(0)
        html += `<li class="list-group-item d-flex justify-content-between">
                    <span class="fw-bold">Total (THB)</span>
                    <strong id='cartPriceTotal' >0</strong>
                </li>`;
        $("#CartItem").html(html)
        return;
    }

    let sub = 0;
    rco.forEach((i, k) => {
        html += `<li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">${i.name_products}</h6>
                    </div>
                    <span class="text-body-secondary">${i.price_unit} x ${i.item} ชิ้น</span>
                </li>`;


        sub += i.price_unit * i.item;
    });




    $("#cartSum").html(rco.length + " รายการ")
    $("#sumMainProduct").html(rco.length)
    $("#sumMainProduct1").html(rco.length)
    html += `<li class="list-group-item d-flex justify-content-between">
                <span class="fw-bold">Total (THB)</span>
                <strong id='cartPriceTotal' ></strong>
            </li>`;
    $("#CartItem").html(html)

    $("#cartPriceTotal").html(sub + " บาท")

}

$(document).ready(function () {
    updateCart();
});
function getCart() {

    let html = ``;

    let sum = 0;
    let rco = JSON.parse(localStorage.getItem('product'));
    rco.forEach((i, k) => {
        html += `
        <tr>
            <td scope="row" class="py-4">
                <div class="cart-info d-flex flex-wrap align-items-center ">
                    <div class="col-lg-3">
                        <div class="card-image">
                            <img src="../img/pro/${i.image_pro}" alt="cloth" class="img-fluid" style="width: 60px; height: 60px; ">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card-detail ps-3">
                            <h5 class="card-title">
                                <a href="javascript:;" class="text-decoration-none">${i.name_products}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            </td>
            <td class="py-4 align-middle">
                <div class="input-group product-qty align-items-center w-50">
                    
                    <input type="number" id="input-${i.id_products}" 
                        onchange="CartProductEdit('${i.id_products}',document.getElementById('input-${i.id_products}').value);"
                        class="form-control input-number text-center p-2 mx-1" value="${i.item}" min='1'>
                    
                </div>
            </td>
            <td class="py-4 align-middle">
                <div class="total-price">
                    <span class="secondary-font fw-medium">${i.price_unit} บาท </span>
                </div>
            </td>
            <td class="py-4 align-middle">
                <div class="total-price">
                    <span class="secondary-font fw-medium">${i.item * i.price_unit} บาท </span>
                </div>
            </td>
            <td class="py-4 align-middle">
                <div class="cart-remove">
                    <a href="javascript:DeleteProductEdit(${i.id_products});">
                        <svg width="24" height="24">
                            <use xlink:href="#trash"></use>
                        </svg>
                    </a>
                </div>
            </td>
        </tr>`;

        sum += i.item * i.price_unit;
    });

    // 
    // $("")
    $("#hrefid").attr("href", "checkout.php?totle=" + sum);
    $("#price-amount").html(sum);
    $("#cart-tbody").html(html);

}


function CartProductEdit(id_products, item) {
    let rco = JSON.parse(localStorage.getItem('product'));


    let tem = [];
    rco.forEach((i, k) => {

        if (id_products == i.id_products) {
            i.item = parseInt(item);
        }

        tem.push(i)

    });
    localStorage.setItem('product', JSON.stringify(tem));
    getCart();
    updateCart();
}

function DeleteProductEdit(id_products) {
    let rco = JSON.parse(localStorage.getItem('product'));


    let tem = [];

    for (const i of rco) {
        if (id_products == i.id_products) {
            continue;
        }
        tem.push(i)
    }

    localStorage.setItem('product', JSON.stringify(tem));

    getCart();
    updateCart();
}


$(document).ready(function () {
    getCart();
});
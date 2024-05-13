

document.getElementById("checout").addEventListener("submit", (e) => {

    e.preventDefault();
    let ev = e.target;

    const form = new FormData(ev);
    form.append("cart", localStorage.getItem('product'))

    fetch("../api/u/checout.php", {
        method: "post",
        body: form,
    }).then(e => e.json()).then(resp => {
        if (resp.error == false) {
            alert("สั่งซื้อสินค้าสำเร็จ");
            localStorage.clear('product');
            location.assign("./print.php?ID=" + resp.LastID);
        } else {
            alert(resp.error);
        }
    })

});
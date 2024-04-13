

document.getElementById("checout").addEventListener("submit", (e) => {

    e.preventDefault();
    let ev = e.target;

    const form = new FormData(ev);
    form.append("cart", localStorage.getItem('product'))

    fetch("../api/u/checout.php", {
        method: "post",
        body: form,
    }).then(e => e.json()).then(resp => {
        console.log(resp)
    })
    
});
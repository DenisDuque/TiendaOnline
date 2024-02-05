document.addEventListener('DOMContentLoaded', function () {
    setCartNumber();

    window.addEventListener('storage', function (event) {
        if (event.key === 'products') {
            setCartNumber();
        }
    });
    
    function setCartNumber() {
        let cartNumber = document.getElementById("cartNumber");
        const productArray = JSON.parse(localStorage.getItem('products')) || [];
        let cartAmount = 0;

        productArray.forEach(function (product) {
            cartAmount += product.amount;
        });

        cartNumber.innerHTML = cartAmount;
    }
});

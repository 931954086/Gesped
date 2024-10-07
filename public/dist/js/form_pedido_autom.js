
    document.addEventListener("DOMContentLoaded", function() {
        var productSelect = document.getElementById("product_id");
        var priceInput = document.getElementById("order_price");

        productSelect.addEventListener("change", function() {
            var selectedOption = productSelect.options[productSelect.selectedIndex];
            var price = selectedOption.getAttribute("data-price");
            priceInput.value = "KZ " + price;
        });
    });

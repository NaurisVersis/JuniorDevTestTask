//delete product
$(document).ready(function () {
    $('#mass-delete').click(function () {
        let container = $(".delete-checkbox:checked").parent();
        let ids = container.map(function () {
            return $(this).data("id");
        }).get();

        $.ajax({
            url: '/delete-products',
            type: 'POST',
            data: {
                'product_ids': ids,
            },
            success: function (data) {
                container.remove();
            },
            error: function (jqXHR) {
            }
        });
    });
});

//add product
$(document).ready(function () {
    //choose type
    $('#productType').change(function () {
        let valueSelected = $(this).find("option:selected").val();
        if(valueSelected !== "") {
            $("#attributes").load("/add-product-attributes/" + valueSelected);
        }
    });
    //validate SKU
    $('#sku').on("blur", function () {
        let skuValue = $(this).val();

        $.ajax({
            url: '/validate-product-sku?sku=' + skuValue,
            type: 'GET',
            success: function (data) {
            },
            error: function (jqXHR) {
                if (jqXHR.status === 409) {
                    alert(jqXHR.responseJSON.error)
                }
            }
        });
    });
});
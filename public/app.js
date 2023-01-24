$(document).ready(function () {
    //delete product
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

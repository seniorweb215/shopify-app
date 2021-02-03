$(document).ready(function() {
    $(".delete-item").on("click", function() {
        if (confirm("Are you confirm?")) {
            var id = $(this).data('id');
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/supplier/category/destroy",
                type: "post",
                dataType: "json",
                data: { "_token": _token, "id": id },
                success: function(resp) {
                    console.log(resp);
                    location.reload();
                },
                error: function(error) {
                    console.log("error");
                }
            })   
        }
    })
    $(".delete-super-item").on("click", function() {
        if (confirm("Are you confirm?")) {
            var id = $(this).data('id');
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/supplier/collection/destroy",
                type: "post",
                dataType: "json",
                data: { "_token": _token, "id": id },
                success: function(resp) {
                    console.log(resp);
                    location.reload();
                },
                error: function(error) {
                    console.log("error");
                }
            })   
        }
    })
    
    $("#add_product").on("click", function() {
        $("#products_modal").modal("show");
    })

    $(".delete-product").on("click", function() {
        if (confirm("Are you confirm?")) {
            var except = $(this).data("id");
            var ids = "";
            $("#selected_product_table .delete-product").each(function() {
                if (except != $(this).data('id')) {
                    ids += $(this).data('id')+",";    
                }
            })
            if (ids != "") {
                var ids = ids.substring(0, ids.length - 1);
            }
            var _token = $("input[name='_token']").val();
            var id = $("#products_modal #hidden_id").val();
            $.ajax({
                url: "/supplier/category/edit_products",
                type: "post",
                dataType: "json",
                data: { "_token": _token, "id": id, "ids": ids },
                success: function(resp) {
                    console.log(resp);
                    location.reload();
                },
                error: function(error) {
                    console.log("error");
                }
            })
        }
    })

    $(".btn-confirm").on("click", function() {
        var ids = "";
        $("#products_modal .check-box").each(function() {
            if($(this).is(':checked')) {
                ids += $(this).data('id')+",";
            }
        })
        if (ids != "") {
            var ids = ids.substring(0, ids.length - 1);
        }
        var _token = $("input[name='_token']").val();
        var id = $("#products_modal #hidden_id").val();
        $.ajax({
            url: "/supplier/category/edit_products",
            type: "post",
            dataType: "json",
            data: { "_token": _token, "id": id, "ids": ids },
            success: function(resp) {
                console.log(resp);
                location.reload();
            },
            error: function(error) {
                console.log("error");
            }
        })
    })
})
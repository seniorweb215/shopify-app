$(document).ready(function() {
    $(".delete-item").on("click", function() {
        if (confirm("Are you confirm?")) {
            var id = $(this).data('id');
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/supplier/product/destroy",
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
    $(".approve-item").on("click", function() {
        ajaxFunc($(this));
    })

    $(".btn-confirm").on("click", function() {
        var price = $("#kt_modal_4 #price").val();
        var inventory = $("#kt_modal_4 #inventory").val();
        var quantity = $("#kt_modal_4 #quantity").val();
        
        if ((price != '' && $.isNumeric(price)) && (Number.isInteger(Number(quantity)) && Number(quantity) <= Number(inventory) && Number(quantity) > 0) ) {
            var id = $("#kt_modal_4 #hidden_id").val();
            var description = $("#kt_modal_4 #description").val();
            var tags = $("#kt_modal_4 #tags").val();
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "/retailer/product/approve",
                type: "post",
                dataType: "json",
                data: { "_token": _token, "id": id, "price": price, "description": description, "tags": tags, "quantity": inventory, "approved": quantity },
                success: function(resp) {
                    console.log(resp);
                    $("#kt_modal_4").modal('hide');
                    location.href = '/retailer/approved_product';
                },
                error: function(error) {
                    console.log("error");
                }
            })
        } else {
            alert("Please input correct value");
        }
    })

    $("#approve_item").on("click", function() {
        ajaxFunc($(this));
    })

    var ajaxFunc = function(that) {
        var id = that.data('id');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/retailer/product/getChanges",
            type: "post",
            dataType: "json",
            data: { "_token": _token, "id": id },
            success: function(resp) {
                $("#kt_modal_4 #price").val(resp[0].price);
                $("#kt_modal_4 #inventory").val(resp[0].quantity);
                $("#kt_modal_4 #hidden_id").val(id);
                $("#kt_modal_4 #description").val(resp[0].description);
                $("#kt_modal_4 #exampleModalLabel").text('Changes of "'+ resp[0].title +'"');
                $("#kt_modal_4").modal('show');
            },
            error: function(error) {
                console.log("error");
            }
        })
    }
})
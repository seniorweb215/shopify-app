$(document).ready(function() {
    $("#supplier_list_table span.kt-badge--info").on("click", function() {
        var id = $(this).data('id');
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/retailer/suppliers/request",
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
    })

    $("#Request_table .actions a").on("click", function() {
        var id = $(this).data('id');
        var status = $(this).attr("receive-type-id");
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "/supplier/requested/receive",
            type: "post",
            dataType: "json",
            data: { "_token": _token, "id": id, "status":status },
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
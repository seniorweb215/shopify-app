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
})
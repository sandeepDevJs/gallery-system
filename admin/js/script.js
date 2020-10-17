$(document).ready(function () {

    var user_id;
    var image_name;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop("disabled", false);
        user_id = $("#user-id").val();
        image_name = $(this).data('image');
    })

    $("#set_user_image").click(function() {
        
        $.ajax({

            url: "includes/ajax_code.php",
            data: {image_name:image_name, user_id:user_id },
            type: "post",
            success: function(data) {
                if(!data.error){
                    $("#user-image").prop("src", data);
                }
            },
            failure: function() {
                alert("internal error has occurred!!");
            }

        });

    });

    $(".delete-link").click(function () {
        return confirm("Are You Sure You Want to Delete it!!");
    });

    $(".photo-delete").click(function () {
        return confirm("Are You Sure You Want to Delete it!!");
    });


});
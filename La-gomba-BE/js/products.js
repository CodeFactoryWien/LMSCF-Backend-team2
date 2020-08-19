$(document).ready(function(){

    // Image upload function
    $("#but_upload").click(function(){
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if (response != 0) {
                    $("#img").attr("src",response);
                    $("#image").attr("value",response); 
                    $(".preview img").show(); // Display image element
                } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'File not uploaded',
                      text: 'Something went wrong!'
                    })
                }
            },
        });
    });

    // Create product function
    $("#productDataButton").click(function(){
        data = $('#productData').serialize();
        $.ajax({
          url: "actions/a_create_product.php",
          type: "post",
          data: data,
        }).done(function(data) {
            Swal.fire(data)
            setTimeout("window.location='products.php'", 2000);
        });
    });

    // Product update function
    $("#productDataUpdateButton").click(function(){
        data = $('#productDataUpdate').serialize();
        $.ajax({
          url: "actions/a_update_product.php",
          type: "post",
          data: data,
        }).done(function(data) {
            Swal.fire(data)
            setTimeout("window.location='products.php'", 2000);
        });
    });

});
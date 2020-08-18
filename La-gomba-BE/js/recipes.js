// Recipe details function
let acc = document.getElementsByClassName("accordion");

for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "flex") {
            panel.style.display = "none";
        } else {
            panel.style.display = "flex";
        }
    });
}


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
    
    // Create recipe function
    $("#recipeDataButton").click(function(){
        data = $('#recipeData').serialize();
        $.ajax({
          url: "actions/a_create_recipe.php",
          type: "post",
          data: data,
        }).done(function(data) {
            Swal.fire(data)
            setTimeout("window.location='recipes.php'", 2000);
        });
    });

    // Recipe update function
    $("#recipeDataUpdateButton").click(function(){
        data = $('#recipeDataUpdate').serialize();
        $.ajax({
          url: "actions/a_update_recipe.php",
          type: "post",
          data: data,
        }).done(function(data) {
            Swal.fire(data)
            setTimeout("window.location='recipes.php'", 2000);
        });
    });

});


$("#add_steps").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_steps").find("input").length+1;
    $("#recipes_steps").append('<label>Step'+$i+':</label><input type="text" id="recipes_description" class="form-control mb-2" name="recipes_description[]">');
});

$("#add_ingredients").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_ingredients").find("input").length;
    let len = (($i/3)+1);
    $("#recipes_ingredients").append(
        '<label class="border border-warning mt-4 p-2">Ingredient '+len+': </label> <br>'+
        '<label>Amount '+len+':</label>'+
        '<input type="text" id="ingredients" class="form-control mb-2" name="ing_amount[]">'+
        '<label>Unit '+len+':</label>'+
        '<input type="text" class="form-control mb-2" name="ing_unit[]">'+
        '<label>Name '+len+':</label>'+
        '<input type="text" class="form-control mb-2" name="ing_description[]">'
	);
});
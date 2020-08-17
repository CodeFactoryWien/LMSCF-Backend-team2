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


$("#add_steps").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_steps").find("input").length+1;
    $("#recipes_steps").append('<label>Step'+$i+':</label><input type="text" id="recipes_description" class="form-control" name="recipes_description[]">');
});

$("#add_ingredients").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_ingredients").find("input").length;
    let len = (($i/3)+1);
    $("#recipes_ingredients").append(
      '<label>Ingredient '+len+': </label> <br>'+
      '<label>Amount '+len+':</label>'+
      '<input type="text" id="ingredients" class="form-control" name="ing_amount[]">'+
      '<label>Unit '+len+':</label>'+
      '<input type="text" class="form-control" name="ing_unit[]">'+
      '<label>Name '+len+':</label>'+
      '<input type="text" class="form-control" name="ing_description[]">'
	);
});
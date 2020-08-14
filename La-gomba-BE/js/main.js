$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text()
  modal.find('.modal-body input').val(recipient)
})






/*
const toggleModal = () => {
    document
        .querySelector(".modal-contact")
        .classList.toggle("modal-contact--hidden");
};

document.querySelector("#contact-show").addEventListener("click", toggleModal);

document.querySelector("#contact-modal").addEventListener("submit", (event) => {
    let form = document.getElementById("form-label");
    form.submit();
    form.reset();
    toggleModal();
    return false;
});

document
    .querySelector(".modal-close-bar-x")
    .addEventListener("click", toggleModal);

document
    .querySelector(".modal-logo-over")
    .addEventListener("click", toggleModal);*/




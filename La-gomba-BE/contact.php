<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img class="img-fluid logo mx-auto" src="img/LaGomba_logo_transparent_bg.png" alt="">
                <button type="button" class="rounded-circle btn btn-warning end" data-dismiss="modal" aria-label="Close">
                   &times;
                </button>
            </div>
            <div class="modal-body border border-warning">
                <h2 class="modal-title text-center" id="exampleModalLabel">Get in touch!</h2>
                <form>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="text-center">
                <p id="result"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_send" class="btn btn-dark w-50 mx-auto">Submit</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btn_send').click(function(){
      let name  = $(":input[name='name']").val();
      let email = $(":input[name='email']").val();
      let desc = $(":input[name='message']").val();
      let varData = 'name=' + name + '&email=' +email+ '&desc=' +desc; 

        $.ajax({
            type: 'POST',
            url: 'actions/email.php',
            data: varData,
            success: function(data){
                $('#result').append('Mail sent. Thank you.')
            },
            error: function(e){
                $('#result').append('Mail not sent. Please try again.');
            }
        });
    });
</script>

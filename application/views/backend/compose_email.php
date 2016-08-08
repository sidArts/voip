<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header">Send Email</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    <?php print (!empty($_POST['email']))? count($_POST['email']): 0; ?> Members selected
                </div>
                <div class="panel panel-body">
                    <form action="<?php print base_url() ?>admin/members/sendMessage" method="post">
                        <div class="form-group">
                            <label>Enter Subject</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Enter Message</label>
                            <textarea name="message" id="editor1" rows="10" cols="80">
                                Enter your message here . . .
                            </textarea>
                        </div>
                        <input type="submit" name="submit" value="Send" class="btn btn-success">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    CKEDITOR.replace( 'editor1' );
</script>
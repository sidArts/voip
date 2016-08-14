<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VoIP - Admin</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/css/sb-admin-2.css">
    <script src="<?php print base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php print base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if ($this->session->flashdata('pwd-reset-flash')): ?>
                <div class="alert alert-info" style="margin-top: 10px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('pwd-reset-flash'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('email-not-found-flash')): ?>
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('email-not-found-flash'); ?>
                </div>
            <?php endif; ?>
            <div class="login-panel panel panel-default" id="email-form">
                <div class="panel-heading">
                    <h3 class="panel-title">Forgot Your Password?</h3>
                </div>
                <div class="panel-body">
                    <?php print form_open(base_url('admin/auth/forgotPassword')) ?>
                    <fieldset>
                        <div class="form-group">
                            <?php
                            print form_label('Enter Email');
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'email';
                            print form_input($input);
                            ?>
                        </div>
                        <?php print form_submit('submit', 'Submit', 'class="btn btn-success btn-block"') ?>
                    </fieldset>
                    <?php form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

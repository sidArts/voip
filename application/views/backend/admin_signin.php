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
            <?php if ($this->session->flashdata('admin-login-failure')): ?>
            <div class="alert alert-danger" style="margin-top: 10px">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print $this->session->flashdata('admin-login-failure'); ?>
            </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('email-not-found-flash')): ?>
                <div class="alert alert-danger" style="margin-top: 10px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('email-not-found-flash'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('pwd-res-success')): ?>
                <div class="alert alert-success" style="margin-top: 10px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('pwd-res-success'); ?>
                </div>
            <?php endif; ?>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <?php print form_open(base_url().'admin/auth', array('autocomplete' => 'off')) ?>
                        <fieldset>
                            <div class="form-group">
                            <?php
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'email';
                            $input['placeholder'] = 'E-mail';
                            print form_input($input);
                            print form_error('email');
                            ?>
                            </div>
                            <div class="form-group">
                            <?php
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'password';
                            $input['placeholder'] = 'Password';
                            print form_password($input);
                            print form_error('password');
                            ?>
                            </div>
                            <!--<div class="checkbox">
                            <label><?php /*print form_checkbox('remember','Remember Me', TRUE); */?> Remember Me</label>
                            </div>-->
                            <!-- Change this to a button or input when using this as a form -->
                            <?php print form_submit('submit', 'Signin', 'class="btn btn-success btn-block"') ?>
                        </fieldset>
                    <?php form_close() ?>
                </div>
                <div style="margin-left: 30px;">
                    <p class="form-group text-muted">
                        Forgot your password?
                        <?php print anchor(base_url('admin/auth/forgotPassword'),'click here','class="btn btn-default btn-xs"') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VoIP - Reset Password</title>

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
            <?php if ($this->session->flashdata('pwd-res-fail')): ?>
                <div class="alert alert-info" style="margin-top: 10px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('pwd-res-fail'); ?>
                </div>
            <?php endif; ?>
            <div class="login-panel panel panel-default" id="new-pwd">
                <div class="panel-heading">
                    <h3 class="panel-title">Reset Password</h3>
                </div>
                <div class="panel-body">
                    <?php print form_open(base_url('users/resetPassword/'.$member_id), array('autocomplete' => 'off')) ?>
                    <fieldset>
                        <div class="form-group">
                            <?php
                            print form_label('Enter Key');
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'key';
                            print form_input($input);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            print form_label('Enter new Password');
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'new-pwd';
                            print form_password($input);
                            print form_error('new-pwd');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            print form_label('Confirm new Password');
                            $input = [];
                            $input['class'] = 'form-control';
                            $input['name'] = 'conf-pwd';
                            print form_password($input);
                            print form_error('conf-pwd');
                            ?>
                        </div>
                        <?php print form_submit('submit', 'Submit', 'class="btn btn-success btn-block"') ?>
                    </fieldset>
                    <?php form_close() ?>
                    <div style="margin-top: 10px">
                        <p class="form-group text-muted">
                            <?php print anchor(base_url('users/forgotPassword'),'click here','class="btn btn-default btn-xs"') ?>
                             to resend email
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

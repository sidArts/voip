
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
                            <div class="checkbox">
                            <label><?php print form_checkbox('remember','Remember Me', TRUE); ?> Remember Me</label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <?php print form_submit('submit', 'Signin', 'class="btn btn-success btn-block"') ?>
                        </fieldset>
                    <?php form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

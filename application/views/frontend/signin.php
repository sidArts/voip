<!--<h1 class="page-header1 text-center">Signin</h1>-->
<!-- Flash message for account verification success   -->
<?php if($this->session->flashdata('activation-success')) { ?>
    <div class="alert alert-info text-center" style="width: 50%; margin: auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('activation-success'); ?>
    </div>
<?php } ?>
<!-- Flash message for account verification failure   -->
<?php if($this->session->flashdata('activation-fail')) { ?>
    <div class="alert alert-danger text-center" style="width: 50%; margin: auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('activation-fail'); ?>
    </div>
<?php } ?>
<!-- Flash message for account activation needed  to continue login-->
<?php if($this->session->flashdata('activate-msg')) { ?>
    <div class="alert alert-warning text-center" style="width: 50%; margin: auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('activate-msg'); ?>
    </div>
<?php } ?>
<!-- Flash message for signin failure   -->
<?php if($this->session->flashdata('signin-failure')) { ?>
    <div class="alert alert-danger" style="width: 50%; margin: auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('signin-failure'); ?>
    </div>
<?php } ?>
<div style="height: 5px;"></div>
<div class="container">
<div class="row">
    <div class="col-lg-2 well" style="height: 700px;">
        <!--  SPACE FOR ADS  -->
    </div>
    <div class="col-lg-4 col-lg-offset-2">
        <div class="well">
            <fieldset>
                <legend><h2>Signin Form</h2></legend>
                <?php print form_open(base_url().'users/signin'); ?>
                <div class="form-group">
                    <?php print form_label('Username or Email') ?>
                    <?php print form_input(array(
                        'name' => 'username',
                        'class' => 'form-control'
                    )); ?>
                    <?php print form_error('username'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Password') ?>
                    <?php print form_password(array(
                        'name' => 'password',
                        'class' => 'form-control'
                    )); ?>
                    <?php print form_error('password'); ?>
                </div>
                <?php print form_submit('submit', 'Signin', 'class="btn btn-info"'); ?>
                <?php print form_close(); ?>
            </fieldset>
        </div>
    </div>
    <div class="col-lg-2 col-lg-offset-2 well"  style="height: 700px;">
    <!--  SPACE FOR ADS  -->
    </div>
</div>
</div>
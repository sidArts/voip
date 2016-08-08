<h1 class="page-header text-center">Signin</h1>
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
<div class="container" style="width: 30%;">

    <!-- Flash message for signin failure   -->
    <?php if($this->session->flashdata('signin-failure')) { ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('signin-failure'); ?>
        </div>
    <?php } ?>
    <div class="well">
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
    </div>
</div>
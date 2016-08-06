<div class="container" style="width: 40%;">
    <!-- Flash message for successfull profile update  -->
    <?php if($this->session->flashdata('prof-update-success')) { ?>
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('prof-update-success'); ?>
        </div>
    <?php } ?>
    <!-- Flash message for profile update failure -->
    <?php if($this->session->flashdata('prof-update-failure')) { ?>
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('prof-update-failure'); ?>
        </div>
    <?php } ?>
    <h1 class="page-header text-center">Settings</h1>
    <ul class="list-group">
        <li class="list-group-item text-center"><a href="#">Change Password</a></li>
        <li class="list-group-item text-center"><a href="<?php print base_url() ?>users/updateProfile">Update Profile</a></li>
        <li class="list-group-item text-center"><a href="#">Delete Account</a></li>
    </ul>
</div>
<?php
$user_id = $this->session->userdata('user_id');
?>
<div class="container">
    <div class="row">
        <h1 class="page-header">Account Summary</h1>
        <div class="col-lg-5">
            <?php if($this->session->flashdata('prof-update-success')): ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('prof-update-success'); ?>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('prof-update-failure')): ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('prof-update-failure'); ?>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('visibility-email')): ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('visibility-email'); ?>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('visibility-phone')): ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('visibility-phone'); ?>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('password-update-success')): ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('password-update-success'); ?>
            </div>
            <?php endif; ?>
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <div class="pull-left">Personal Information <i class="fa fa-info-circle fa-lg"></i></div>
                            <div class="pull-right">
                                <a href="<?php print base_url() ?>users/updateProfile" class="btn btn-default btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <td><?php print $info->name; ?></td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td><?php print (!$info->company)? 'Not mentioned':$info->company; ?></td>
                            </tr>
                            <tr>
                                <th>Joined At</th>
                                <td><?php print date('F j, Y, g:i a',strtotime($info->created_at)); ?></td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td><?php print date('F j, Y, g:i a',strtotime($info->updated_at)); ?></td>
                            </tr>
                            <tr>
                                <th>Referred By</th>
                                <td><?php print ($info->referral) ? $info->referral : 'None'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Settings -->
                <div class="panel panel-danger">
                    <div class="panel-heading">Settings <i class="fa fa-gear fa-lg"></i></div>
                    <div class="panel-body">
                        <?php if(!empty($error)): ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php print $error; ?>
                        </div>
                        <?php endif; ?>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Change Password</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                    <?php print form_open(base_url('users/info')); ?>
                                        <div class="form-group">
                                        <?php print form_label('Current Password') ?>
                                        <?php print form_password(array(
                                            'name' => 'old-pwd',
                                            'class' => 'form-control'
                                        )); print form_error('old-pwd'); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php print form_label('New Password') ?>
                                            <?php print form_password(array(
                                                'name' => 'new-pwd',
                                                'class' => 'form-control'
                                            )); print form_error('new-pwd');  ?>
                                        </div>
                                        <div class="form-group">
                                            <?php print form_label('Confirm New Password') ?>
                                            <?php print form_password(array(
                                                'name' => 'conf-new-pwd',
                                                'class' => 'form-control'
                                            )); print form_error('conf-new-pwd'); ?>
                                        </div>
                                        <?php print form_submit('submit', 'Submit', 'class="btn btn-primary"') ?>
                                    <?php print form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Deactivate Account</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p class="panel text-muted bg-danger">
                                            <strong>Deleting</strong> your account will remove all your data. If you'll be away for
                                            some time then you may want to <strong>Deactivate</strong> your account which will
                                            make your profile inactive. You can again reactivate it any time.
                                        </p>
                                        <p class="panel">
                                        <?php print anchor('users/deactivateAccount', 'Deactivate','class="btn btn-warning btn-sm" onclick="return askSure()"') ?>
                                        <?php print anchor('users/deleteAccount', 'Delete','class="btn btn-danger btn-sm" onclick="return askSure()"') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Contact Information -->
            <div class="panel panel-warning">
                <div class="panel-heading">Contact Information <i class="fa fa-envelope"></i></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Email</th>
                            <td>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <?php print $info->email; ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php
                                        if($info->email_visible):
                                            print anchor('users/changeEmailVisibility','<i class="fa fa-eye fa-2x"></i>','title="Click here to hide your email" onclick="return askEmail()"');
                                        else:
                                            print anchor('users/changeEmailVisibility','<i class="fa fa-eye-slash fa-2x"></i>','title="Click here to share your email" onclick="return askEmail()"');
                                        endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <?php print ($info->phone) ? $info->phone : 'not available'; ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php
                                        if($info->phone_visible):
                                            print anchor('users/changePhoneVisibility','<i class="fa fa-eye fa-2x"></i>','title="Click here to hide your phone" onclick="return askPhone()"');
                                        else:
                                            print anchor('users/changePhoneVisibility','<i class="fa fa-eye-slash fa-2x"></i>','title="Click here to share your phone" onclick="return askPhone()"');
                                        endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function askEmail() {
        return confirm('Are you sure want to change your email visibility?');
    }
    function askPhone() {
        return confirm('Are you sure want to change your phone visibility?');
    }
    function askSure() {
        return confirm('Are you sure want to continue?');
    }
</script>

<?php
$user_id = $this->session->userdata('user_id');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-7">
            <h1 class="page-header">Account Summary</h1>
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <div class="pull-left">Personal Information</div>
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

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="clearfix">
                        <div class="pull-left">Contact Information</div>
                        <div class="pull-right">
                        <?php if($info->show_contact_info == 0) { ?>
                            <label class="label label-warning">
                                <a class="my-label"
                                   href="<?php print base_url() ?>users/show_hide_contact"
                                   onclick="return confirm('Are you sure want to share your contact details?')">hidden</a>
                            </label>
                        <?php } if($info->show_contact_info == 1) { ?>
                            <label class="label label-success">
                                <a class="my-label"
                                   href="<?php print base_url() ?>users/show_hide_contact"
                                   onclick="return confirm('Are you sure want to hide your contact details?')">visible</a>
                            </label>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Email</th>
                                <td><?php print $info->email; ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php print ($info->phone) ? $info->phone : 'not available'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

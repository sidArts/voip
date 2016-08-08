<?php
$user_id = $this->session->userdata('user_id');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-7">
            <?php if($user_id == $info->id){ ?>
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="page-header">Account Summary</h1>
                </div>
                <div class="col-lg-4">
                    <div class="page-header text-right" style="border-bottom: none;">
                        <a class="btn btn-default btn-sm" href="<?php print base_url() ?>users/updateProfile"><i class="glyphicon glyphicon-pencil"></i> update</a>
                    </div>
                </div>
            </div>

            <?php } else { ?>
            <h1 class="page-header">User Details</h1>
            <?php } ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">Personal Information</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <td><?php print $info->name; ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?php print $info->username; ?></td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td><?php print (!$info->company)? 'Not mentioned':$info->company; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="pull-left">Contact Information</p>
                        <p class="pull-right">
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
                        </p>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Email</th>
                                <td><?php print $info->email; ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php print $info->phone; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

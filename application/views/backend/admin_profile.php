<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <?php if ($this->session->flashdata('pwd-update-fail')): ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print $this->session->flashdata('pwd-update-fail'); ?>
            </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('pwd-update-success')): ?>
                <div class="alert alert-success" style="margin-top: 5px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $this->session->flashdata('pwd-update-success'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" style="margin-top: 5px">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print $error; ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-primary" style="margin-top: 10px;" style="margin-top: 5px">
                <div class="panel-heading"><h1 class="page-header">Member Information</h1></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Administrator ID</th>
                            <td><?php print $admin->id; ?></td>
                        </tr>
                        <tr>
                            <th>Administrator Name</th>
                            <td><?php print $admin->name; ?></td>
                        </tr>
                        <tr>
                            <th>Administrator Email</th>
                            <td><?php print $admin->email ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <?php print date('F j, Y, g:i a', strtotime($admin->updated_at)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                <div class="col-lg-6">
                                <div class="panel-group">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse1">Change Password</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                            <?php print form_open(base_url('admin/dashboard/profile')); ?>
                                            <div class="form-group">
                                                <?php print form_label('Enter Current Password');
                                                print form_password(array(
                                                    'name' => 'curr-pwd',
                                                    'class' => 'form-control'));
                                                print form_error('curr-pwd'); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php print form_label('Enter New Password');
                                                print form_password(array(
                                                    'name' => 'new-pwd',
                                                    'class' => 'form-control'));
                                                print form_error('new-pwd'); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php print form_label('Enter New Password');
                                                print form_password(array(
                                                    'name' => 'conf-pwd',
                                                    'class' => 'form-control'));
                                                print form_error('conf-pwd'); ?>
                                            </div>
                                            <?php print form_submit('submit', 'Update','class="btn btn-primary"'); ?>
                                            <?php print form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
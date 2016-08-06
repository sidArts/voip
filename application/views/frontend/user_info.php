<?php
$user_id = $this->session->userdata('user_id');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <?php if($user_id == $info->id): ?>
            <h3 class="page-header">Account Summary</h3>
            <?php endif; ?>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <td>
                        <?php print $info->name; ?>
                        <?php if($user_id == $info->id): ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <?php print $info->username; ?>
                        <?php if($user_id == $info->id): ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>
                        <?php print (!$info->company)? 'Not mentioned':$info->company; ?>
                        <?php if($user_id == $info->id): ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?php print $info->email; ?>
                        <?php if($user_id == $info->id): ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        <?php print $info->phone; ?>
                        <?php if($user_id == $info->id): ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
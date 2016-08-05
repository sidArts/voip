<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3 class="page-header">Account Summary</h3>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <td>
                        <?php print $info->name; ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <?php print $info->username; ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>
                        <?php print (!$info->company)? 'Not mentioned':$info->company; ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?php print $info->email; ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        <?php print $info->phone; ?>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
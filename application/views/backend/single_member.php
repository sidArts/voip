<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default" style="margin-top: 10px;">
                <div class="panel-heading"><h1 class="page-header">Member Information</h1></div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Member Name</th>
                            <td><?php print $member->name; ?></td>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <td><?php print $member->company ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php print $member->email ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php print $member->phone ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php print $member->username ?></td>
                        </tr>
                        <tr>
                            <th>Date Joined</th>
                            <td><?php print $member->created_at ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td><?php print $member->updated_at ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
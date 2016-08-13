<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-primary" style="margin-top: 10px;">
                <div class="panel-heading"><h1 class="page-header">Member Information</h1></div>
                <div class="panel-body">
                    <table class="table table-hover">
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
                            <td><?php print ($member->phone) ? $member->phone : 'not provided'; ?></td>
                        </tr>
                        <tr>
                            <th>Date Joined</th>
                            <td>
                                <?php print date('F j, Y, g:i a', strtotime($member->created_at)); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <?php print date('F j, Y, g:i a', strtotime($member->updated_at)); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Referred By</th>
                            <td>
                                <?php print ($member->referral) ? $member->referral : 'none'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                            <?php if($member->is_verified == 1) { ?>
                                <label class="label label-success">verified</label>
                            <?php } else { ?>
                                <label class="label label-warning">inactive</label>
                            <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
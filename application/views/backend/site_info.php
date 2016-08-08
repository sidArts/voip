<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default" style="margin-top: 10px;">
                <div class="panel-heading"><h1 class="page-header">Site Information</h1></div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Title</th>
                            <td><?php print $site_info->site_title; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php print $site_info->site_email ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php print $site_info->site_phone ?></td>
                        </tr>
                        <tr>
                            <th>Homepage Image</th>
                            <td><?php print $site_info->site_homepage_image ?></td>
                        </tr>
                        <tr>
                            <th>About Text</th>
                            <td><?php print $site_info->site_about ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <?php print date('F j, Y, g:i a', strtotime($site_info->updated_at)) ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
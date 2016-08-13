<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
        <?php if($this->session->flashdata('update-success')) : ?>
            <div class="alert alert-success" style="margin-top: 5px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('update-success'); ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('update-failure')) : ?>
            <div class="alert alert-success" style="margin-top: 5px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('update-failure'); ?>
            </div>
        <?php endif; ?>
            <div class="panel panel-primary" style="margin-top: 10px;">
                <div class="panel-heading">
                    <h1 class="page-header">
                        <div class="clearfix">
                            <div class="pull-left">Site Information</div>
                            <div class="pull-right">
                                <a href="<?php print base_url() ?>admin/dashboard/editInfo" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> update</a>
                            </div>
                        </div>
                    </h1>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Title</th>
                            <td><?php print $site_info->site_title; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php print $site_info->site_name; ?></td>
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
                            <td>
                                <img height="200px" width="300px" src="<?php print base_url("assets/uploads/").'/'.$site_info->site_homepage_image ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>About Text</th>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#view-about" class="btn btn-success btn-xs">view</button>
                            </td>
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
<div id="view-about" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Site Description</h4>
            </div>
            <div class="modal-body">
                <p class="container"><?php print $site_info->site_about ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
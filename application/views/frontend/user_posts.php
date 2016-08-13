<div class="container">
    <h1 class="page-header">My Posts</h1>
    <div class="row">
        <div class="col-lg-10">
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Note :</strong> Posts older than <?php print $post_time_limit; ?> days will be automatically erased!
            </div>
            <?php if($this->session->flashdata('post-success')) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('post-success'); ?>
                </div>
            <?php } ?>
            <?php if($this->session->flashdata('status-flash')) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('status-flash'); ?>
                </div>
            <?php } ?>
            <?php if($this->session->flashdata('post-del-flash')) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('post-del-flash'); ?>
                </div>
            <?php } ?>
            <table id="postTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Sl. no.</th>
                    <th class="text-center">Post type</th>
                    <th class="text-center">Breakout Destination</th>
                    <th class="text-center">Rate (USD)</th>
                    <th class="text-center">Quality Level</div>
        <!--            <th>Description</th>-->
                    <th class="text-center">Views</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($posts)) { ?>
                        <?php $slno = 1; ?>
                        <?php foreach($posts as $value): ?>
                            <tr>
                                <td class="text-center"><?php print $slno++; ?></td>
                                <td class="text-center"><?php print $value->post_type; ?></td>
                                <td class="text-center"><?php print $value->country; ?></td>
                                <td class="text-center"><?php print $value->rate; ?></td>
                                <td class="text-center"><?php print $value->quality_level; ?></td>
                                <!--            <td>--><?php //print $value->description; ?><!--</td>-->
                                <td class="text-center"><?php print $value->views; ?></td>
                                <td class="text-center"><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                                <td class="text-right" style="width: 210px;">
                                    <a href="<?php print base_url(); ?>search/compare/<?php print $value->id; ?>" class="btn btn-info btn-xs">matching engine</a>
                                    <a href="<?php print base_url(); ?>posts/view/<?php print $value->id; ?>" class="btn btn-primary btn-xs">view more</a>
                                    <?php /*if($value->status == 1) { */?><!--
                                        <a href="<?php /*print base_url(); */?>posts/change_status/<?php /*print $value->id; */?>" onclick="return statusConfirm()" class="btn btn-success btn-xs">active</a>
                                    <?php /*} else { */?>
                                        <a href="<?php /*print base_url(); */?>posts/change_status/<?php /*print $value->id; */?>" onclick="return confirm('Are you sure want to make it active?')" class="btn btn-warning btn-xs">inactive</a>
                                    --><?php /*} */?>
                                    <a href="<?php print base_url(); ?>posts/delete/<?php print $value->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want ot delete?');"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; } else { ?>
                    <tr>
                        <td colspan="8" class="text-center text-danger">No posts yet</td>
                    </tr>
                </tbody>
                    <?php } ?>
            </table>
        </div>
        <div class="col-lg-2 well" style="height: 700px;">

        </div>
    </div>
</div>
<script>
    function statusConfirm() {
        return confirm('Are you sure want to change status?');
    }
    $(document).ready(function(){
        $('#postTable').DataTable();
    });
</script>
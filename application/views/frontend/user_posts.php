<div class="container">
    <h1 class="page-header">My Posts</h1>
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
    <table class="table table-bordered">
        <tr>
            <th>Sl. no.</th>
            <th>Post type</th>
            <th>Quality Level</div>
            <th>Description</th>
            <th>Country</th>
            <th>Views</th>
            <th>Last Updated</th>
            <th class="text-right">Action</th>
        </tr>
    <?php $slno = 1; ?>
    <?php foreach($posts as $value): ?>
        <tr>
            <td><?php print $slno++; ?></td>
            <td><?php print $value->post_type; ?></td>
            <td><?php print $value->country; ?></td>
            <td><?php print $value->quality_level; ?></td>
            <td><?php print $value->description; ?></td>

            <td class="text-center"><?php print $value->views; ?></td>
            <td><?php print $value->updated_at; ?></td>
            <td class="text-right">
                <a href="<?php print base_url(); ?>posts/view/<?php print $value->id; ?>" class="btn btn-primary btn-xs">view more</a>
                <?php if($value->status == 1) { ?>
                <a href="<?php print base_url(); ?>posts/change_status/<?php print $value->id; ?>" onclick="return statusConfirm()" class="btn btn-success btn-xs">active</a>
                <?php } else { ?>
                <a href="<?php print base_url(); ?>posts/change_status/<?php print $value->id; ?>" onclick="return Confirm('Are you sure want to make it active?')" class="btn btn-warning btn-xs">inactive</a>
                <?php } ?>
                <a href="<?php print base_url(); ?>posts/delete/<?php print $value->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want ot delete?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<script>
    function statusConfirm() {
        return confirm('Are you sure want to change status?');
    }
</script>
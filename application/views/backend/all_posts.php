<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary" style="margin-top: 5px;">
                <div class="panel-heading"><h1 class="page-header">All Posts</h1></div>
                <div class="panel-body">
                    <table id="postTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Sl. no.</th>
                                <th class="text-center">Post type</th>
                                <th class="text-center">Country</th>
                                <th class="text-center">Rate (USD)</th>
                                <th class="text-center">Quality Level</th>
                <!--            <th>Description</th>-->
                                <th class="text-center">Views</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td style="width: 120px;" class="text-center">
                                    <a href="<?php print base_url('admin/members/info').'/'.$value->user_id; ?>">
                                        <?php print $value->name; ?>
                                    </a>
                                </td>
                                <td class="text-center"><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                                <td class="text-right" style="width: 100px;">
                                    <a href="<?php print base_url(); ?>admin/posts/view/<?php print $value->post_id; ?>" class="btn btn-primary btn-xs">view more</a>
                                    <a href="<?php print base_url(); ?>posts/delete/<?php print $value->post_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want ot delete?');"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#postTable').DataTable();
    });
</script>

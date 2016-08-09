<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary" style="margin-top: 5px;">
                <div class="panel-heading"><h1 class="page-header">All Posts</h1></div>
                <div class="panel-body">
                    <table id="postTable" class="table-bordered">
                        <thead>
                        <tr>
                            <th>Sl. no.</th>
                            <th>Post type</th>
                            <th>Country</th>
                            <th>Rate</th>
                            <th>Quality Level</div>
                <!--            <th>Description</th>-->
                <th>Views</th>
                <th>Date Created</th>
                <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($posts)) { ?>
                    <?php $slno = 1; ?>
                    <?php foreach($posts as $value): ?>
                        <tr>
                            <td><?php print $slno++; ?></td>
                            <td><?php print $value->post_type; ?></td>
                            <td><?php print $value->country; ?></td>
                            <td><?php print $value->rate; ?></td>
                            <td><?php print $value->quality_level; ?></td>
                            <!--            <td>--><?php //print $value->description; ?><!--</td>-->
                            <td class="text-center"><?php print $value->views; ?></td>
                            <td><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                            <td class="text-right">
                                <a href="<?php print base_url(); ?>admin/posts/view/<?php print $value->id; ?>" class="btn btn-primary btn-xs">view more</a>
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
            </div>
        </div>
    <script>
        $(document).ready(function(){
            $('#postTable').DataTable();
        });
    </script>
    </div>
</div>
<div class="container">
    <h1 class="page-header">Search Post</h1>
    <div class="row">
        <div class="col-lg-10">
            <table id="searchTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sl. no.</th>
                        <th>Post Type</th>
                        <th>Country</th>
                        <th>Quality Level</th>
        <!--            <th>Description</th>-->
                        <th>Rate (USD)</th>
                        <th>ASR (%)</th>
                        <th>ACD (min)</th>
                        <th>Views</th>
                        <th>Date Added</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
            <?php $slno = 1;
            foreach($results as $value):
                if($value->user_id != $this->session->userdata('user_id')): ?>
                <tr>
                    <td class="text-center"><?php print $slno++; ?></td>
                    <td class="text-center"><?php print $value->post_type; ?></td>
                    <td class="text-center"><?php print $value->country; ?></td>
                    <td class="text-center"><?php print $value->quality_level; ?></td>
                    <td class="text-center"><?php print $value->rate; ?></td>
    <!--                <td>--><?php //print $value->description; ?><!--</td>-->
                    <td class="text-center"><?php print $value->asr; ?></td>
                    <td class="text-center"><?php print $value->acd; ?></td>
                    <td class="text-center"><?php print $value->views; ?></td>
                    <td class="text-center"><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                    <td class="text-right" style="width: 150px;">
                        <a href="<?php print base_url(); ?>search/compare/<?php print $value->post_id; ?>" class="btn btn-info btn-xs">compare</a>
                        <a href="<?php print base_url(); ?>posts/view/<?php print $value->post_id; ?>" class="btn btn-primary btn-xs">view more</a>
                    </td>
                </tr>
            <?php endif;
            endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-2 well" style="height: 700px;">

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#searchTable').DataTable();
    });
</script>
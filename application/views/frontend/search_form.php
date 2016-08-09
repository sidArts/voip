<div class="container">
    <h1 class="page-header">Search</h1>

    <div class="row">
        <?php print form_open(base_url().'search/') ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <?php
                    $selected = $this->input->post('category');
                    print form_dropdown('category',array(
                        ''=>'-- All Category --',
                        'PUSH'=>'PUSH',
                        'TARGET'=>'TARGET'
                    ),$selected,'class="form-control"');
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <?php
                    $selected = $this->input->post('country');
                    $options = array('' => '--All Countries--');
                    foreach ($countries as $value) { $options[$value->nicename] = $value->nicename; }
                    print form_dropdown('country',$options,$selected,'class="form-control"');
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <?php
                    $selected = $this->input->post('quality-level');
                    $options = array('' => '--All Quality Levels--', 'CLI' => 'CLI', 'Non-CLI' => 'Non-CLI', 'CC' => 'CC');
                    print form_dropdown('quality-level',$options,$selected,'class="form-control"');
                    ?>
                </div>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        <?php print form_close(); ?>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <table id="searchTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. no.</th>
                        <th>Post Type</th>
                        <th>Country</th>
                        <th>Quality Level</th>
        <!--            <th>Description</th>-->
                        <th>Rate</th>
                        <th>ASR</th>
                        <th>ACD</th>
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
                    <td><?php print $slno++; ?></td>
                    <td><?php print $value->post_type; ?></td>
                    <td><?php print $value->country; ?></td>
                    <td><?php print $value->quality_level; ?></td>
                    <td><?php print $value->rate; ?></td>
    <!--                <td>--><?php //print $value->description; ?><!--</td>-->
                    <td><?php print $value->asr; ?></td>
                    <td><?php print $value->acd; ?></td>
                    <td><?php print $value->views; ?></td>
                    <td><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                    <td class="text-right" style="width: 150px;">
                        <a href="<?php print base_url(); ?>search/compare/<?php print $value->id; ?>" class="btn btn-info btn-xs">compare</a>
                        <a href="<?php print base_url(); ?>posts/view/<?php print $value->id; ?>" class="btn btn-primary btn-xs">view more</a>
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
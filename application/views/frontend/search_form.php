<div class="container">
    <h1 class="page-header">Search</h1>
    <div class="row">
        <?php print form_open(base_url().'search/') ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <?php
                    print form_dropdown('category',array(
                        ''=>'-- All Category --',
                        'PUSH'=>'PUSH',
                        'TARGET'=>'TARGET'
                    ),'','class="form-control"');
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <?php
                    $options = array('' => '--All Countries--');
                    foreach ($countries as $value) { $options[$value->nicename] = $value->nicename; }
                    print form_dropdown('country',$options,'','class="form-control"');
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        <?php print form_close(); ?>
    </div>
    <?php if(!empty($results)) { ?>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th>Sl. no.</th>
                <th>Post Type</th>
                <th>Country</th>
                <th>Quality Level</div>
                <th>Description</th>
                <th>ASR</th>
                <th>ACD</th>
                <th>Date Added</th>
                <th class="text-right">Action</th>
            </tr>
        <?php $slno = 1; ?>
        <?php foreach($results as $value): ?>
            <tr>
                <td><?php print $slno++; ?></td>
                <td><?php print $value->post_type; ?></td>
                <td><?php print $value->country; ?></td>
                <td><?php print $value->quality_level; ?></td>
                <td><?php print $value->description; ?></td>
                <td><?php print $value->asr; ?></td>
                <td><?php print $value->acd; ?></td>
                <td><?php print $value->created_at; ?></td>
                <td class="text-right">
                    <a href="<?php print base_url(); ?>posts/view/<?php print $value->id; ?>" class="btn btn-primary btn-xs">view more</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <?php } else { ?>
    <div class="row well">
        No results found
    </div>
    <?php } ?>
</div>
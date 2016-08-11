<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print $member_count ?></div>
                        <div>All Members!</div>
                    </div>
                </div>
            </div>
            <a href="<?php print base_url() ?>admin/members/">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list-alt fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php print $post_count ?></div>
                        <div>All Posts</div>
                    </div>
                </div>
            </div>
            <a href="<?php print base_url() ?>admin/posts">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel" id="post-day-info">
            Post Day Limit is set to <strong><?php print $post_day_limit; ?> days</strong>
            <button class="btn btn-default btn-sm" type="button" id="button1"><i class="fa fa-pencil fa-lg"></i> edit</button>
        </div>
        <div class="panel" id="post-day-form" style="display: none;">
            <?php print form_open(base_url('admin/dashboard')); ?>
                <div class="form-group">
                    <?php print form_label('Enter Post Day Limit');
                    print form_input(['name' => 'post-days', 'class' => 'form-control', 'value' => set_value('post-days')]);
                    print form_error('post-days'); ?>
                </div>
                <?php print form_submit('','Go','class="btn btn-default btn-sm"'); ?>
            <?php print form_close(); ?>
        </div>
    </div>
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->
<script>
    $(document).ready(function () {
       $('#button1').click(function () {
           $('#post-day-form').toggle(500);
       });
    });
</script>
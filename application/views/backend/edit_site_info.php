<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-10">
            <?php if(!empty($upload_error)): ?>
            <div class="alert alert-warning" style="margin-top: 5px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $upload_error; ?>
            </div>
            <?php endif; ?>
            <div class="panel panel-primary" style="margin-top: 10px;">
                <div class="panel-heading">
                    <h1 class="page-header">Update Site Information</h1>
                </div>
                <div class="panel-body">
                <?php print form_open_multipart(base_url().'admin/dashboard/editInfo') ?>
                    <div class="form-group">
                    <?php print form_label('Site Title');
                    print form_input(array(
                        'name' => 'title',
                        'class' => 'form-control',
                        'value' => $site_info->site_title
                    ));
                    print form_error('title'); ?>
                    </div>
                    <div class="form-group">
                        <?php print form_label('Site Name');
                        print form_input(array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'value' => $site_info->site_name
                        ));
                        print form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <?php print form_label('Site Email');
                        print form_input(array(
                            'name' => 'email',
                            'class' => 'form-control',
                            'value' => $site_info->site_email
                        ));
                        print form_error('email'); ?>
                    </div>
                    <div class="form-group">
                        <?php print form_label('Site Phone');
                        print form_input(array(
                            'name' => 'phone',
                            'class' => 'form-control',
                            'value' => $site_info->site_phone
                        ));
                        print form_error('phone'); ?>
                    </div>
                    <div class="form-group">
                        <?php print form_label('Homepage Image');
                        print form_upload(array(
                            'name' => 'userfile',
                            'class' => 'form-control'
                        )); ?>
                        <div class="help-block">
                            <img height="200px" width="300px" src="<?php print base_url() ?>assets/uploads/<?php print $site_info->site_homepage_image ?>">
                        </div>
                        <?php print form_error('phone'); ?>
                    </div>
                    <div class="form-group">
                        <?php print form_label('Site About');
                        print form_textarea(array(
                            'name' => 'about',
                            'id' => 'about',
                            'value' => $site_info->site_about
                        )); print form_error('about'); ?>
                    </div>
                <?php print form_hidden('old-image',$site_info->site_homepage_image) ?>
                <?php print form_submit('submit', 'Update','class="btn btn-success"');
                print form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.config.height = 350;
    CKEDITOR.replace('about');
</script>
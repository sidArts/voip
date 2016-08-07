<h1 class="page-header text-center">Add a Post</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-2 well" style="height: 700px;"></div>
        <div class="col-lg-6 col-lg-offset-1">

            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Note :</strong> Posts older than 10 days will be automatically erased!
            </div>
            <div class="well">
            <?php print form_open(base_url().'posts/add'); ?>
                <div class="form-group">
                    <?php print form_label('Select Destination'); ?>
                    <select class="form-control" name="country">
                        <option value="">-- Select Country --</option>
                        {countries}
                        <option value="{nicename}">{nicename}</option>
                        {/countries}
                    </select>
                    <?php print form_error('country'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Select Post Type'); ?>
                    <?php print form_dropdown('post-type',array(
                        '' => '-- Select Post Type --',
                        'PUSH' => 'PUSH',
                        'TARGET' => 'TARGET'
                    ),'','class="form-control"'); ?>
                    <?php print form_error('post-type'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Select Quality Level'); ?>
                    <?php print form_dropdown('quality',array(
                        '' => '-- Select Quality Level --',
                        'CLI' => 'CLI',
                        'Non-CLI' => 'Non-CLI',
                        'PREMIUM' => 'PREMIUM'
                    ),'','class="form-control"'); ?>
                    <?php print form_error('quality'); ?>
                </div>
                <div class="form-group">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php print form_label('ASR');?>
                            <?php print form_input(array(
                                'name' => 'asr',
                                'class' => 'form-control',
                                'placeholder' => 'Answer-Seizure ratio'
                            )) ?>
                        </div>
                        <div class="col-lg-6">
                            <?php print form_label('ACD');?>
                            <?php print form_input(array(
                                'name' => 'acd',
                                'class' => 'form-control',
                                'placeholder' => 'Accurate call duration'
                            )) ?>
                        </div>
                    </div>
                    <?php print form_error('asr'); ?>
                    <?php print form_error('acd'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Enter Rate'); ?>
                    <?php print form_input(array(
                        'name' => 'rate',
                        'class' => 'form-control'
                    )); ?>
                    <?php print form_error('rate'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Description'); ?>
                    <?php print form_textarea(array(
                        'name' => 'description',
                        'class' => 'form-control'
                    )) ?>
                    <?php print form_error('description'); ?>
                </div>
                <?php print form_submit('submit', 'Submit','class="btn btn-primary btn-lg btn-block"'); ?>
            <?php print form_close(); ?>
            </div>
        </div>
        <div class="col-lg-2 col-lg-offset-1 well" style="height: 700px;"></div>
    </div>
</div>
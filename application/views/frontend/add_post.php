<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3 class="page-header">Add a Post</h3>
            <?php print form_open(base_url().'posts/add'); ?>
                <div class="form-group">
                    <?php print form_label('Select Post Type'); ?>
                    <?php print form_dropdown('post-type',array(
                        '' => '-- select post type --',
                        'PUSH' => 'PUSH',
                        'TARGET' => 'TARGET'
                    ),'','class="form-control"'); ?>
                    <?php print form_error('post-type'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('Select Quality Level'); ?>
                    <?php print form_dropdown('quality',array(
                        '' => '-- select quality level --',
                        'CLI' => 'CLI',
                        'Non-CLI' => 'Non-CLI',
                        'CC' => 'CC'
                    ),'','class="form-control"'); ?>
                    <?php print form_error('quality'); ?>
                </div>
                <div class="form-group">
                    <?php print form_label('ASR, ACD');?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php print form_input(array(
                                'name' => 'asr',
                                'class' => 'form-control',
                                'placeholder' => 'Answer-Seizure ratio'
                            )) ?>
                        </div>
                        <div class="col-lg-6">
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

                <div class="form-group">
                    <?php print form_label('Select Country'); ?>
                    <select class="form-control" name="country">
                        <option value="">-- select country --</option>
                        {countries}
                        <option value="{nicename}">{nicename}</option>
                        {/countries}
                    </select>
                    <?php print form_error('country'); ?>
                </div>
                <?php print form_submit('submit', 'Submit','class="btn btn-primary"'); ?>
            <?php print form_close(); ?>
        </div>
    </div>
</div>
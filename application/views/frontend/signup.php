<div class="container" style="width: 500px;">
    <h1 class="page-header">Signup</h1>

    <?php print form_open(base_url().'users/signup'); ?>
        <div class="form-group">
            <?php print form_label('Name'); ?>
            <?php print form_input(array(
                'name' => 'name',
                'class' => 'form-control',
                'value' => set_value('name')
            )); ?>
            <?php print form_error('name'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Username'); ?>
            <?php print form_input(array(
                'name' => 'username',
                'class' => 'form-control',
                'value' => set_value('username')
            )); ?>
            <?php print form_error('username'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Password'); ?>
            <?php print form_password(array(
                'name' => 'password',
                'class' => 'form-control'
            )) ?>
            <?php print form_error('password'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Re-Type Password'); ?>
            <?php print form_password(array(
                'name' => 'conf-password',
                'class' => 'form-control'
            )) ?>
            <?php print form_error('conf-password'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Email'); ?>
            <?php print form_input(array(
                'name' => 'email',
                'class' => 'form-control',
                'value' => set_value('email')
            )); ?>
            <?php print form_error('email'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Company'); ?>
            <?php print form_input(array(
                'name' => 'company',
                'class' => 'form-control',
                'value' => set_value('company')
            )); ?>
            <?php print form_error('company'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Contact'); ?>
            <div class="row">
                <div class="col-lg-5">
                    <select name="country-code" class="form-control">
                        <option value="">--select country--</option>
                        {countries}
                        <option value="+{phonecode}-">{name} [ +{phonecode} ] </option>
                        {/countries}
                    </select>
                </div>
                <div class="col-lg-7">
                    <?php print form_input(array(
                        'name' => 'phone',
                        'class' => 'form-control',
                        'value' => set_value('phone')
                    )); ?>
                </div>
            </div>
            <?php echo form_error('country-code'); ?>
            <?php echo form_error('phone'); ?>
        </div>
        <?php print form_submit('submit', 'Signup', 'class="btn btn-success"'); ?>
    <?php print form_close(); ?>

</div>
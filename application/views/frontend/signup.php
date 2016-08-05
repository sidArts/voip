<?php $page1 = $this->uri->segment(2);?>
<div class="container" style="width: 500px;">
    <h1 class="page-header">
        <?php if($page1 == 'updateProfile') {
            print 'Update Profile';
        } else {
            print 'Signup';
        } ?>
    </h1>
    <?php
    if($page1 == 'signup') {
        print form_open(base_url().'users/signup');
    }
    if($page1 == 'updateProfile'){
        print form_open(base_url().'users/updateProfile');
    }
    ?>
        <div class="form-group">
            <?php print form_label('Name'); ?>
            <?php
            $input['name'] = 'name';
            $input['class'] = 'form-control';
            if($page1 == 'updateProfile'){
                $input['value'] = $profile->name;
            } else {
                $input['value'] = set_value('name');
            }
            print form_input($input); ?>
            <?php print form_error('name'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Username'); ?>
            <?php
            $input['name'] = 'username';
            $input['class'] = 'form-control';
            if($page1 == 'updateProfile'){
                $input['value'] = $profile->username;
            } else {
                $input['value'] = set_value('name');
            }
            print form_input($input); ?>
            <?php print form_error('username'); ?>
        </div>
    <?php if($page1 != 'updateProfile'){ ?>
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
    <?php } ?>
        <div class="form-group">
            <?php print form_label('Email'); ?>
            <?php
            $input['name'] = 'email';
            $input['class'] = 'form-control';
            if($page1 == 'updateProfile'){
                $input['value'] = $profile->email;
            } else {
                $input['value'] = set_value('email');
            }
            print form_input($input); ?>
            <?php print form_error('email'); ?>
        </div>
        <div class="form-group">
            <?php
            print form_label('Company');
            $input['name'] = 'company';
            $input['class'] = 'form-control';
            if($page1 == 'updateProfile'){
            $input['value'] = $profile->company;
            } else {
            $input['value'] = set_value('company');
            }
            print form_input($input); ?>
            <?php print form_error('company'); ?>
        </div>
        <div class="form-group">
            <?php print form_label('Phone'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <?php
                    $options[''] = '-- select country code --';
                    foreach($countries as $country) {
                        $options[$country->phonecode] = "$country->phonecode - [ $country->nicename ]";
                    }
                    if($page1 == 'updateProfile'){
                        $selected = explode('-',$profile->phone)[0];
                    } else {
                        $selected = '';
                    }
                    print form_dropdown('country-code',$options,$selected,'class="form-control"');
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    $input['name'] = 'phone';
                    $input['class'] = 'form-control';
                    if($page1 == 'updateProfile'){
                        $input['value'] = end(explode('-',$profile->phone));
                    } else {
                        $input['value'] = set_value('phone');
                    }
                    print form_input($input);
                    ?>
                </div>
            </div>
            <?php echo form_error('country-code'); ?>
            <?php echo form_error('phone'); ?>
        </div>
        <?php
        if($page1 == 'updateProfile') {
            print form_submit('submit', 'Update', 'class="btn btn-success"');
        } else {
            print form_submit('submit', 'Signup', 'class="btn btn-success"');
        }
        ?>
    <?php print form_close(); ?>

</div>
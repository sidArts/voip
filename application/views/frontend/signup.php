<?php $page1 = $this->uri->segment(2);?>
<div class="container" style="width: 70%;">
    <h1 class="page-header">
        <?php if($page1 == 'updateProfile') {
            print 'Update Profile';
        } else {
            print 'Signup';
        } ?>
    </h1>
    <div class="well">
    <?php
    if($page1 == 'signup') {
        print form_open(base_url().'users/signup');
    }
    if($page1 == 'updateProfile'){
        print form_open(base_url().'users/updateProfile');
    }
    ?>
        <div class="row">
            <div class="col-lg-6">
                <h3 class="page-header">Personal Information</h3>
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
                    <?php  print form_label('Company');
                    $input['name'] = 'company';
                    $input['class'] = 'form-control';
                    if($page1 == 'updateProfile'){
                        $input['value'] = $profile->company;
                    } else {
                        $input['value'] = set_value('company');
                    }
                    print form_input($input);
                    print form_error('company'); ?>
                </div>
                <div class="form-group">
                    <?php  print form_label('Referral');
                    $input['name'] = 'referral';
                    $input['class'] = 'form-control';
                    if($page1 == 'updateProfile'){
                        $input['value'] = $profile->referral;
                    } else {
                        $input['value'] = set_value('referral');
                    }
                    print form_input($input);
                    print form_error('referral'); ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="page-header">Contact Information</h3>
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
                    <?php print form_label('Phone'); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $options[''] = '-- Select Country Code --';
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
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox"> Accept - </label>
                <a href="#" data-toggle="modal" data-target="#termsconditions">Terms & Conditions</a>
            </div>
        </div>
        <?php
        if($page1 == 'updateProfile') {
            print form_submit('submit', 'Update', 'class="btn btn-success"');
        } else {
            print form_submit('submit', 'Signup', 'class="btn btn-success btn-lg btn-block1"');
        }
        ?>
    <?php print form_close(); ?>
    </div>
</div>

<!-- Modal -->
<div id="termsconditions" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
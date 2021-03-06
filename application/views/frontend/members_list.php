<div class="container">
    <h1 class="page-header">Members</h1>
    <div class="row">
        <div class="col-lg-10">
        <!-- Contact mail success -->
            <?php if($this->session->flashdata('contact-mail-success')) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('contact-mail-success'); ?>
            </div>
            <?php } ?>
        <!-- Contact mail failure -->
            <?php if($this->session->flashdata('contact-mail-failure')) {?>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php print $this->session->flashdata('contact-mail-failure'); ?>
            </div>
            <?php } ?>
            <table id="membersListTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center">Sl. no.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Company</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Joined at</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $slno = 1; ?>
                <?php foreach($members as $value): ?>
                <tr>
                    <td class="text-center"><?php print $slno++; ?></td>
                    <td class="text-center"><?php print $value->name; ?></td>
                    <td class="text-center"><?php print $value->company; ?></td>
                    <td class="text-center">
                        <?php
                        if($value->email_visible):
                            print ($value->email_visible)?$value->email: 'not provided';
                        else:
                            print '<i class="fa fa-eye-slash fa-lg"></i>';
                        endif;
                        ?>
                    </td>
                    <td class="text-center">
                    <?php
                        if($value->phone_visible):
                            print ($value->phone)?$value->phone: 'not provided';
                        else:
                            print '<i class="fa fa-eye-slash fa-lg"></i>';
                        endif;
                    ?>
                    </td>
                    <td class="text-center"><?php print date('F j, Y, g:i a',strtotime($value->created_at)); ?></td>
                    <td class="text-right">
                        <?php if($value->email_visible == 0){ ?>
                        <button class="btn btn-success btn-xs disabled"><i class="glyphicon glyphicon-envelope"></i> send email</button>
                        <?php } else { ?>
                        <button class="btn btn-success btn-xs"
                                user-email="<?php print $value->email; ?>"
                                onclick="populateData(this);"
                                data-toggle="modal"
                                data-target="#contactModal"><i class="glyphicon glyphicon-envelope"></i> send email</button>
                        <?php } ?>
                        <!--<a href="<?php /*echo base_url(); */?>users/info">view more</a>-->
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-2 well" style="height: 700px;">

        </div>
    </div>
</div>
<!-- Modal -->
<div id="contactModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contact Member</h4>
            </div>
            <div class="modal-body">
                <?php print form_open(base_url().'users', array('name' => 'contact')); ?>
                <div class="form-group">
                    <?php
                    $input['name'] = 'email';
                    $input['class'] = 'form-control';
                    $input['readonly'] = 'true';
                    print form_label('To');
                    print form_input($input);
                    ?>
                </div>
                <div class="form-group">
                    <?php $input = [];
                    $input['name'] = 'subject';
                    $input['class'] = 'form-control';
                    $input['placeholder'] = 'Add a subject';
                    print form_label('Subject');
                    print form_input($input);
                    ?>
                </div>
                <div class="form-group">
                    <?php $input = [];
                    $input['name'] = 'description';
                    $input['class'] = 'form-control';
                    print form_label('Add Message');
                    print form_textarea($input);
                    ?>
                </div>
                <?php
                print form_submit('submit','Send Message','class="btn btn-primary"');
                print form_close();
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script>
function populateData(element) {
    var email = element.getAttribute('user-email');
    document.contact.email.value = email;
}
$(document).ready(function(){
    $('#membersListTable').DataTable();
});
</script>
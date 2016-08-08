<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Site Members</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Flash message for email success  -->
            <?php if($this->session->flashdata('email-info')) { ?>
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('email-info'); ?>
                </div>
            <?php } ?>
            <!-- Flash message for email fail  -->
            <?php if($this->session->flashdata('email-info-warning')) { ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('email-info-warning'); ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <input type="button"
                           class="btn btn-success btn-sm"
                           data-toggle="modal"
                           data-target="#emailModal"
                           value="Compose Message"
                           id="compose">
                </div>
                <div class="panel-body">
                    <table id="membersListTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" id="select-all">
                                    Sl. no.
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Joined at</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php print form_open(base_url().'admin/members'); ?>
                        <?php $slno = 1; ?>
                        <?php foreach($members as $value): ?>
                            <tr>
                                <td class="text-center">
                                    <label>
                                        <input type="checkbox" name="email[]" value="<?php print $value->email; ?>" class="member-email">
                                        <?php print $slno++; ?>
                                    </label>
                                </td>
                                <td><?php print $value->name; ?></td>
                                <td><?php print $value->email; ?></td>
                                <td><?php print $value->username; ?></td>
                                <td><?php print $value->company; ?></td>
                                <td><?php print $value->phone; ?></td>
                                <td><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                                <td class="text-right">
                                    <a href="<?php echo base_url(); ?>admin/members/info/<?php print $value->id ?>" class="btn btn-info btn-xs">view more</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <div id="emailModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title">Contact Members</h2>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <?php print form_label('Enter Subject'); ?>
                                            <?php print form_input(array(
                                                'name' => 'subject',
                                                'class' => 'form-control'
                                            )); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php print form_label('Enter Message'); ?>
                                            <?php print form_textarea(array(
                                                'name' => 'message',
                                                'id' => 'message',
                                                'class' => 'form-control'
                                            )); ?>
                                        </div>
                                        <?php print form_submit('submit', 'Send','class="btn btn-success"'); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php print form_close() ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#select-all').change(function () {
        var member_email = $('.member-email');
        for(var i = 0; i < member_email.length; i++) {
           member_email[i].checked = document.getElementById('select-all').checked;
        }
    });
    $('#compose').attr('disabled','');
    $('#select-all').change(function () {
        if($('.member-email:checked').length == 0 ) {
            $('#compose').attr('disabled','');
        } else {
            $('#compose').removeAttr('disabled');
        }
    });
    $('.member-email').change(function () {
        if($('.member-email:checked').length == 0 ) {
            $('#compose').attr('disabled','');
            $('#select-all').attr('checked','');
        } else {
            $('#compose').removeAttr('disabled');
        }
    });
});
</script>
<!-- Modal -->

<script>
    CKEDITOR.replace( 'message' );
</script>
<div class="container">
    <h1 class="page-header">Post Details</h1>
    <div class="row">
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
        <div class="col-lg-5">
            <table class="table table-bordered">
                <tr>
                    <th>Post Type</th>
                    <td><?php print $post->post_type; ?></td>
                </tr>
                <tr>
                    <th>Quality Level</th>
                    <td><?php print $post->quality_level ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php print $post->description ?></td>
                </tr>
                <tr>
                    <th>ASR</th>
                    <td><?php print $post->asr ?></td>
                </tr>
                <tr>
                    <th>ACD</th>
                    <td><?php print $post->acd ?></td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td><?php print $post->country ?></td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td><?php print date('F j, Y, g:i a', strtotime($post->created_at)) ?></td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td><?php print $post->views ?></td>
                </tr>
                <tr>
                    <th>Posted By</th>
                    <td>
                        <p class="pull-left">
                            <?php print $post->username ?> (<?php print $post->name ?>)
                        </p>
                        <p class="pull-right">
                            <button class="btn btn-success btn-xs" user-email="<?php print $post->email; ?>" onclick="populateData(this);" data-toggle="modal" data-target="#contactModal">contact</button>
                        </p>
                    </td>
                </tr>
            </table>
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
                <?php print form_open(base_url().'posts/view/'.$post->id, array('name' => 'contact')); ?>
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
</script>
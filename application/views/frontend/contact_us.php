<div class="container">
    <h1 class="page-header1 text-center">Contact Us</h1>
    <div class="row">
        <div class="col-lg-2 well" style="height: 700px">
        <!-- SPACE FOR ADS -->
        </div>
        <div class="col-lg-6 col-lg-offset-1 well">
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
            <fieldset>
                <legend>Contact Form</legend>
            <form action="<?php print base_url(); ?>home/contact" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Firstname *</label>
                            <input id="form_name" type="text" name="fname" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_lastname">Lastname *</label>
                            <input id="form_lastname" type="text" name="lname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_email">Email *</label>
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_phone">Phone</label>
                            <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_subject">Subject *</label>
                            <input id="form_subject" name="subject" class="form-control" placeholder="Email Subject *" rows="4" required="required" data-error="Please,leave us a message.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" name="submit" class="btn btn-success btn-send" value="Send message">
                    </div>
                </div>
            </form>
            </fieldset>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted" style="padding: 10px;"><strong>*</strong> These fields are required.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-lg-offset-1 well" style="height: 700px">
            <!-- SPACE FOR ADS -->
        </div>
    </div>

</div>
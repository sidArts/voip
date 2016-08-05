<div class="container">
    <h1 class="page-header">Welcome to VoIP</h1>
<!-- Flash message for successfull signup  -->
    <?php if($this->session->flashdata('signup-success')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('signup-success'); ?>
    </div>
    <?php } ?>

<!-- Flash message for already signed in    -->
    <?php if($this->session->flashdata('already-logged')) { ?>
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('already-logged'); ?>
        </div>
    <?php } ?>
<!-- Flash message for signin success   -->
    <?php if($this->session->flashdata('signin-success')) { ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('signin-success'); ?>
        </div>
    <?php } ?>
   <!-- Flash message for logout success   -->
    <?php if($this->session->flashdata('logout-success')) { ?>
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('logout-success'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('login-warning')) { ?>
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('login-warning'); ?>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-7">
            <p class="bg-info" style="padding: 20px;">
                We are in the wholesale VOIP minutes business.
                There are over 50000 destinations companies are selling now.
                I am attaching a sample rate sheet for your reference so that you know what it is all about.
                There are over 100K worldwide operators currently and everyone wants to buy cheap from someone and sell high to others.
                Unfortunately, the margin is slim nowadays and in some cases, it can be as low as 2%.
                As such, everyone is looking for lower rates and at the same time, looking for buyers who are willing to buy higher.

            </p>
        </div>
        <div class="col-lg-4">

        </div>
    </div>

</div>
<div class="container">
<!--    <h1 class="page-header">Welcome to VoIP</h1>-->
<!-- Flash message for successfull signup  -->
    <?php if($this->session->flashdata('signup-success')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php print $this->session->flashdata('signup-success'); ?>
    </div>
    <?php } ?>
    <!-- Flash message for signup failure -->
    <?php if($this->session->flashdata('signup-fail')) { ?>
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $this->session->flashdata('signup-fail'); ?>
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
</div>
<style>
    .jumbotron{
        background: url('<?php print base_url() ?>assets/images/banner.jpg');
        /*background-position: center;*/
        background-size: cover;
        min-height: 400px;
        margin: 0;
    }
</style>
    <div class="jumbotron"></div>
<div class="container" style="width: 80%;">
    <h1 class="page-header text-center">Welcome to VOIP</h1>
    <p class="bg-info" style="padding: 20px;">
        We are in the wholesale VOIP minutes business.
        There are over 50000 destinations companies are selling now.
        I am attaching a sample rate sheet for your reference so that you know what it is all about.
        There are over 100K worldwide operators currently and everyone wants to buy cheap from someone and sell high to others.
        Unfortunately, the margin is slim nowadays and in some cases, it can be as low as 2%.
        As such, everyone is looking for lower rates and at the same time, looking for buyers who are willing to buy higher.

    </p>
    <div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Collapsible Group Item #2
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Collapsible Group Item #3
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="well well-lg">

    </div>
</div>

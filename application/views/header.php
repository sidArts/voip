<?php if(!BASEPATH) { print 'No direct access allowed'; exit; } ?>
<?php $page = $this->uri->segment(1); ?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php print base_url(); ?>">VoIP</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php if($page == 'home' || $page == ''){ print 'class="active"'; } ?>><a href="<?php echo base_url(); ?>home"><i class="glyphicon glyphicon-home"></i> Home</a></li>

            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
            <li class="dropdown <?php if($page == 'posts'){ print 'active'; } ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list-alt"></i> Post <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php print base_url(); ?>posts"><i class="glyphicon glyphicon-list-alt"></i> My Posts</a></li>
                    <li><a href="<?php print base_url(); ?>posts/add"><i class="glyphicon glyphicon-plus-sign"></i> Add a Post</a></li>
                </ul>
            </li>

            <li class="<?php if($page == 'search'){ print "active"; }?>">
                <a href="<?php print base_url(); ?>search">
                    <i class="glyphicon glyphicon-search"></i> Search
                </a>
            </li>

            <li <?php if($page == 'users' && $this->uri->segment(2) == ''){ print 'class="active"'; } ?>><a href="<?php print base_url(); ?>users"><i class="glyphicon glyphicon-list"></i> All Members</a></li>
            <?php } ?>
            <!--    before login        -->
            <li <?php if($this->uri->segment(2) == 'contact'){ print 'class="active"'; } ?>><a href="<?php print base_url(); ?>home/contact"><i class="glyphicon glyphicon-envelope"></i> Contact us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
<!-- after login-->
        <?php if($this->session->userdata('logged_in') == TRUE) { ?>
            <li class="dropdown <?php if($page == 'users' && $this->uri->segment(2) != '') { print 'active'; } ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php print $this->session->userdata('name'); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>users/info"><i class="glyphicon glyphicon-info-sign"></i> view information</a></li>
                    <li><a href="<?php echo base_url(); ?>users/settings"><i class="glyphicon glyphicon-cog"></i> settings</a></li>
                    <li><a href="<?php print base_url(); ?>users/logout"><i class="glyphicon glyphicon-log-out"></i> logout</a></li>
                </ul>
            </li>
        <?php } else { ?>
<!-- Before login-->
            <li <?php if($this->uri->segment(2) == 'signin'){ print 'class="active"'; } ?>><a href="<?php echo base_url();?>users/signin"><i class="glyphicon glyphicon-log-in"></i> Signin</a></li>
            <li <?php if($this->uri->segment(2) == 'signup'){ print 'class="active"'; } ?>><a href="<?php echo base_url();?>users/signup"><i class="glyphicon glyphicon-user"></i> Signup</a></li>
        <?php } ?>
        </ul>

    </div>
</nav>
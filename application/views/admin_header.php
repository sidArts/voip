<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php print base_url(); ?>admin"><?php print $site->site_name; ?> - Dashboard</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php print $this->session->userdata('admin_name'); ?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
<!--                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>-->
<!--                    </li>-->
<!--                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
<!--                    </li>-->
<!--                    <li class="divider"></li>-->
                    <li><a href="<?php print base_url() ?>admin/dashboard/profile"><i class="fa fa-user fa-fw"></i> view profile</a>
                    <li><a href="<?php print base_url() ?>admin/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php print base_url() ?>admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php print base_url() ?>admin/dashboard/siteInfo"><i class="fa fa-info fa-fw"></i> Site Info</a>
                    </li>
                    <li>
                        <a href="<?php print base_url() ?>admin/members"><i class="fa fa-user fa-fw"></i> Members</a>
                    </li>
                    <li>
                        <a href="<?php print base_url() ?>admin/posts"><i class="fa fa-list-alt fa-fw"></i> Posts</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
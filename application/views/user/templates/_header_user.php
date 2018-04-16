<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/user/css/lity.min.css'); ?>" />
        <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url('assets/user/css/alertify.core.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/user/css/alertify.default.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/user/css/dataTables.bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/user/css/responsive.bootstrap.min.css'); ?>" />

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/user/css/user-panel.css'); ?>" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <div class="user-thumb data-img" data-bg="<?php echo base_url('assets/user/img/banner/banner-2.jpg'); ?>">
                        <div class="overlay">
                            <img src="<?php echo (get_user_info()->default_photo != null) ? base_url(get_user_info()->default_photo) : get_gravatar(get_user_info()->email); ?>" class="img-responsive" />
                        </div>
                    </div>
                    <div class="user-details">
                        <ul>
                            <li><?php echo get_user_info()->first_name.' '.get_user_info()->last_name; ?></li>
                            <li class="text-muted"><?php echo get_user_info()->email; ?></li>
                            <li class="text-muted"><?php echo get_user_info()->token; ?></li>
                        </ul>
                    </div>
                </div>
                <ul class="sidebar-nav">
                    <li>
                        <a href="<?php echo base_url('user/overview'); ?>"><i class="fa fa-tachometer"></i> Overview</a>
                    </li>
                    <li>
                        <a href="#jao-dropdown" data-toggle="collapse"><i class="fa fa-globe"></i> JAO Data</a>
                        <ul id="jao-dropdown" class="collapse list-unstyled side-dropdown">
                            <li><a href="<?php echo base_url('user/jao/information'); ?>"><i class="fa fa-user"></i> JAO Information</a></li>
                            <li><a href="<?php echo base_url('user/jao/trip-history'); ?>"><i class="fa fa-history"></i> Trip History</a></li>
                            <li><a href="<?php echo base_url('user/jao/download'); ?>" target="_blank"><i class="fa fa-download"></i> JAO App!</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#setting-dropdown" data-toggle="collapse"><i class="fa fa-cog"></i> Settings</a>
                        <ul id="setting-dropdown" class="collapse list-unstyled side-dropdown">
                            <li><a href="<?php echo base_url('user/my-account'); ?>"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="<?php echo base_url('user/password-management'); ?>"><i class="fa fa-lock"></i> Password Management</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('user/signout'); ?>"><i class="fa fa-sign-out"></i> Sign Out</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <div class="user-<?php echo $page; ?>-content user-panel-content-wrap">

                    <section class="user-panel-header">
                        <div class="container-fluid">
                            <h1>
                                <a type="button" class="app-drawer hidden-lg hidden-md hidden-sm" id="menu-toggle">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <?php echo $title; ?>
                            </h1>
                        </div>
                    </section>
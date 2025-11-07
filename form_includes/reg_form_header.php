<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

<!--<![endif]-->

<!-- BEGIN HEAD -->



<head>

    <meta charset="utf-8" />

    <title><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"

        type="text/css" />

    <link href="forms_assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="forms_assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

    <link href="forms_assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <?php if (!isset($ex_pay_bts)) { ?>

        <link href="forms_assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />

    <?php } ?>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->



    <link href="forms_assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />

    <link href="forms_assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />



    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="forms_assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />

    <link href="forms_assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />

    <link href="forms_assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- END THEME LAYOUT STYLES -->

    <link href="forms-css/custom-style.css" rel="stylesheet" type="text/css" />

    <!-- <link rel="shortcut icon" href="favicon.ico" /> -->

    <?php if (isset($pageStyleCss))

        echo $pageStyleCss;

    ?>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400&display=swap');

.form-hero {
    background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url(https://sci25.supercomputingindia.org//images/SCI2025_EXI.jpg) center / cover no-repeat !important;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 100% 31%;
        position: relative;
        overflow: hidden;
        min-height: 300px;
        display: flex;
        align-items: end;
        position: relative;
        z-index: 1;
        padding-bottom: 40px;
    }
    .form-hero h2 {
      font-family: 'Poppins';
      color: #fff;
      font-size: 45px;
      font-weight: 700;
      margin-bottom: 10px;  
    }
    @media (max-width: 767.98px) {
        .form-hero .container {
            margin: 0px 16px;
        }
        .form-hero {
            min-height: 240px;
        }
    }
    </style>

</head>

<!-- END HEAD -->



<body class="page-header-fixed page-boxed page-content-white page-md dips-background-color-body">

    <!-- BEGIN HEADER -->

    <!-- For header fixed .navbar-fixed-top -->
    <?php require ('navbar.php');?>

    <section class="form-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <?php
                    //print current url
                    
                    $url = $_SERVER['REQUEST_URI'];

                    // if the url contains registration info then show registration else show enquiry
                    if (strpos($url, 'registration' ) !== false) {
                        $pageTitle = 'Registration Form';
                    } else if (strpos($url, 'info') !== false) {
                        $pageTitle = 'Registration Form';
                    }
                     else if (strpos($url, 'exhibitor') !== false) {
                        $pageTitle = 'Exhibitor Registration';
                    } else if (strpos($url, 'sponsorship') !== false) {
                        $pageTitle = 'Sponsorship Registration';
                    } else if (strpos($url, 'speaker') !== false) {
                        $pageTitle = 'Speaker Registration';
                    } else if (strpos($url, 'volunteer') !== false) {
                        $pageTitle = 'Volunteer Registration';
                    } else if (strpos($url, 'workshop') !== false) {
                        $pageTitle = 'Workshop Registration     ';
                    } else if (strpos($url, 'tutorial') !== false) {
                        $pageTitle = 'Tutorial Registration';
                    } else if (strpos($url, 'conference') !== false) {
                        $pageTitle = 'Conference Registration';
                    } else if (strpos($url, 'partner') !== false) {
                        $pageTitle = 'Partner Registration';
                    } else if (strpos($url, 'media') !== false) {
                        $pageTitle = 'Media Registration';
                    } else if (strpos($url, 'process_import') !== false) {
                        $pageTitle = 'Import Registration';
                    }
			else if(strpos($url, 'ieee') !=false){
				$pageTitle = 'Copyright Submission';
			} 
                    else {
                        // default to enquiry
                        $pageTitle = 'Enquiry Form';
                    }

                    ?>
                    <h2><?php echo $pageTitle; ?></h2>
                </div>
            </div>
        </div>
    </section>
    <?php /*
    <div class="page-header navbar dips-background-color-header" style="display: none;">

        <!-- BEGIN HEADER INNER -->

        <div class="page-header-inner container">

            

            <!-- BEGIN LOGO -->

            <div class="page-logo">

                <a href="<?php echo $EVENT_WEBSITE_LINK; ?>" target="_blank">

                    <?php if (!isset($ex_pay_bts)) { ?>

                        <img src="<?php echo $EVENT_LOGO_LINK; ?>" alt="logo" class="logo-default " height="150"/>
                        
                    <?php }  ?>


                </a>

            </div>

            <!-- END LOGO -->

        </div>

        <!-- END HEADER INNER -->

    </div>
    */ ?>

    <!-- END HEADER -->

    <!-- BEGIN HEADER & CONTENT DIVIDER -->

    <div class="clearfix"> </div>

    <!-- END HEADER & CONTENT DIVIDER -->

    <!-- BEGIN CONTAINER -->

    <div class="container">

        <!-- BEGIN PAGE CONTENT -->

        <div class="page-container">

            <!-- BEGIN CONTENT -->

            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->

                <div class="page-content dips-page-content">

                    <!-- BEGIN PAGE TITLE-->

                    <h3 class="page-title hide"></h3>

                    <!-- END PAGE TITLE-->

                    <!-- END PAGE HEADER-->

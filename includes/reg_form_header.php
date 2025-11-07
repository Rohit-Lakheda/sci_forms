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

    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <?php if (!isset($ex_pay_bts)) { ?>

        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />

    <?php } ?>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->



    <link href="assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />

    <link href="assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />



    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />

    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- END THEME LAYOUT STYLES -->

    <link href="css/custom-style.css" rel="stylesheet" type="text/css" />

    <!-- <link rel="shortcut icon" href="favicon.ico" /> -->

    <?php if (isset($pageStyleCss))

        echo $pageStyleCss;

    ?>

</head>

<!-- END HEAD -->



<body class="page-header-fixed page-boxed page-content-white page-md dips-background-color-body">

    <!-- BEGIN HEADER -->

    <!-- For header fixed .navbar-fixed-top -->

    <div class="page-header navbar dips-background-color-header">

        <!-- BEGIN HEADER INNER -->

        <div class="page-header-inner container">

            <!-- BEGIN LOGO -->

            <div class="page-logo">

                <a href="<?php echo $EVENT_WEBSITE_LINK; ?>" target="_blank">

                    <?php if (!isset($ex_pay_bts)) { ?>

                        <img src="<?php echo $EVENT_LOGO_LINK; ?>" alt="logo" class="logo-default " />

                    <?php } else { ?>

                        <img src="https://www.bengalurutechsummit.com/web/it_forms/images/BTS-2019_StartUp-Zone-Web-Banner-1_revised-v.gif"

                            alt="logo" class="logo-default " style="width:100% !important;" />

                    <?php } ?>

                </a>

                <?php if (isset($ex_iBIOMLOGO)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/images/iBIOMLOGO.png?asfs" alt="logo"

                        class="logo-default dips-logo1" width="14%" style="margin-left: 4%;" />

                <?php } ?>



                <?php if (isset($ex_tie)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/assets/Tie.jpg?asfs" alt="logo"

                        class="logo-default dips-logo1" width="20%" style="margin-left: 4%;" />

                <?php } ?>



                <?php if (isset($ex_nain)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/assets/Nain-logo.png?asfs" alt="logo"

                        class="logo-default dips-logo1" width="28%" style="margin-left: 4%;" />

                <?php } ?>

                <?php if (isset($ex_gcpit)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/assets/GCPIT.png?asfs" alt="logo"

                        class="logo-default dips-logo1" width="250" height="150" style=" float: right; " />

                <?php } ?>

                <?php if (isset($ex_elevate)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/assets/Elevate-Logo-PNG.png?asfs" alt="logo"

                        class="logo-default dips-logo1" width="150" height="100" style="margin-top: 50px; float: right; " />

                <?php } ?>

                <?php if (isset($ex_ibiom)) { ?>

                    <img src="https://www.bengalurutechsummit.com/web/it_forms/assets/iBIOMLOGO.png?asfs" alt="logo"

                        class="logo-default dips-logo1" width="150" height="100" style="margin-top: 50px; float: right; " />

                <?php } ?>

            </div>

            <!-- END LOGO -->

        </div>

        <!-- END HEADER INNER -->

    </div>

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
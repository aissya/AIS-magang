<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title ?></title>
        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/highcharts.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery1.6.1.js') ?>"></script>


        <link rel="icon" href="<?php echo base_url('assets/img/url.jpeg'); ?>" >
        <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/pace/pace-theme-minimal.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck/skins/square/blue.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/switchery/switchery.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>" >
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2-bootstrap.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-slider/css/slider.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-datatables/css/dataTables.bootstrap.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-niftymodal/css/component.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-gritter/css/jquery.gritter.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/skins.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>" >
    </head>

    <body class="skin-blue">
        <!-- BEGIN HEADER -->
        <header class="header">
            <!-- BEGIN LOGO -->
            <a href="<?php echo base_url('index.php/basis/home_c'); ?>" class="logo">
                <img src="<?php echo base_url('assets/img/logo.png'); ?>" height="35">
            </a>
            <!-- END LOGO -->
            <!-- BEGIN NAVBAR -->
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars fa-lg"></span>
                </a>

                <!-- BEGIN RIGHT ICON -->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <li class="dropdown profile-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user fa-lg"></i>
                                <span class="username"></span>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu box profile">
                                <li><div class="up-arrow"></div></li>
                                <li >
                                    <?php
                                    $session = $this->session->all_userdata();
                                    $npk = $session['NPK'];
                                    ?>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('index.php/login_c/off'); ?>"><i class="fa fa-power-off"></i>Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- BEGIN RIGHT ICON -->
            </nav>
            <!-- END NAVBAR -->
        </header>
        <!-- END HEADER -->

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- BEGIN SIDEBAR -->
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel" >
                        <div class="pull-left image">
                            <?php
                            $filename = './assets/img/user/' . $npk . '.jpg';
                            if (file_exists($filename)) {
                                ?><img src="<?php echo base_url('assets/img/user/' . $npk . '.jpg'); ?>" class="img-circle" alt="User Image">'<?php
                            } else {
                                ?><img src="<?php echo base_url('assets/img/user/unknown.jpg'); ?>" class="img-circle" alt="User Image">'<?php
                            }
                            ?>
                        </div>
                        <div class="pull-left info">
                            <p class="text-left"><strong><?php
                                    echo $session['USERNAME'];
                                    ?></strong></p>

                            <?php
                            $x = NULL;
                            foreach ($app as $value) {
                                if ($x == NULL) {
                                    $x = $value->CHR_ROLE;
                                } else {
                                    break;
                                }
                            }
                            ?>
                            <p class="text-left"><?php echo $x ?></a>
                        </div>
                    </div>
                    <!--#001599-->
                    <ul class="sidebar-menu">
                        <?php
                        $ap_stat = NULL;
                        $fun_stat = NULL;
                        $mod_stat = NULL;
                        foreach ($app as $app_data) {
                            if ($sidebar->INT_ID_APP == $app_data->INT_ID_APP) {
                                $ap_stat = 'active';
                            } else {
                                $ap_stat = 'null';
                            }
                            echo '<li class="menu ' . $ap_stat . '"><a href="#"><i class="fa fa-' . $app_data->CHR_ICON . '"></i><span>' . strtoupper(trim($app_data->CHR_APP)) . '</span><i class="fa fa-angle-left pull-right"></i></a>';
                            echo '<ul class="sub-menu">';
                            foreach ($module as $module_data) {
                                if ($app_data->INT_ID_APP == $module_data->INT_ID_APP) {
                                    if ($sidebar->INT_ID_MODULE == $module_data->INT_ID_MODULE) {
                                        $mod_stat = 'active';
                                    } else {
                                        $mod_stat = 'null';
                                    }
                                    if ($module_data->INT_LEVEL == '1') {

                                        echo '<li class="menu ' . $mod_stat . '">';
                                        echo '<a href="#"><span>' . $module_data->CHR_MODULE, '</span><i class="fa fa-angle-left pull-right"></i></a>';
                                        echo '<ul class="sub-menu">';
                                        foreach ($function as $function_data) {

                                            if ($module_data->INT_ID_MODULE == $function_data->INT_ID_MODULE) {
                                                if ($sidebar->INT_ID_FUNCTION == $function_data->INT_ID_FUNCTION) {
                                                    $fun_stat = ' style="border-left:1px solid #eeeeee; color:white"';
                                                    $fun_ac = 'style="color:white"';
                                                } else {
                                                    $fun_stat = null;
                                                    $fun_ac = null;
                                                }
                                                echo '<li' . $fun_stat . '><a ' . $fun_ac . ' href=' . base_url('/index.php/' . trim($function_data->CHR_URL) . '>' . $function_data->CHR_FUNCTION . '</a></li>');
                                            }
                                        }
                                        echo '</ul>';
                                        echo '</li>';
                                    } else {
                                        foreach ($function as $function_data) {
                                            if ($module_data->INT_ID_MODULE == $function_data->INT_ID_MODULE) {
                                                if ($sidebar->INT_ID_FUNCTION == $function_data->INT_ID_FUNCTION) {
                                                    $fun_stat = ' style="border-left:1px solid #eeeeee; color:white"';
                                                    $fun_ac = 'style="color:white"';
                                                } else {
                                                    $fun_stat = null;
                                                    $fun_ac = null;
                                                }
                                                echo '<li' . $fun_stat . '><a ' . $fun_ac . ' href=' . base_url('index.php/' . trim($function_data->CHR_URL)) . '><span> ' . $module_data->CHR_MODULE . '</span></a></li>';
                                            }
                                        }
                                    }
                                }
                            }

                            echo '</ul>';
                            echo'</li>';
                        }
                        ?></ul>
                </section>
            </aside>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <?php $this->load->view($content); ?>
            <!-- END CONTENT -->

            <!-- BEGIN SCROLL TO TOP -->
            <div class="scroll-to-top"></div>
            <!-- END SCROLL TO TOP -->
        </div>

        <!-- BEGIN JS FRAMEWORK -->
        <script src="<?php echo base_url('assets/plugins/jquery-2.1.0.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
        <!-- END JS FRAMEWORK -->

        <!-- BEGIN JS PLUGIN -->
        <script src="<?php echo base_url('assets/plugins/pace/pace.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-totemticker/jquery.totemticker.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-resize/jquery.ba-resize.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-blockui/jquery.blockUI.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/icheck/icheck.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js') ?>"></script>
        
        
        <script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/select2/select2.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-slider/js/bootstrap-slider.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/form.js') ?>"></script>

        <script src="<?php echo base_url('assets/plugins/jquery-datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-datatables/js/dataTables.bootstrap.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables.js') ?>"></script>

        <script src="<?php echo base_url('assets/plugins/jquery-niftymodal/js/classie.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-niftymodal/js/modalEffects.js') ?>"></script>

        <script src="<?php echo base_url('assets/plugins/jquery-gritter/js/jquery.gritter.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/notification.js') ?>"></script>

        <script src="<?php echo base_url('assets/plugins/jquery-flot/jquery.flot.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-flot/jquery.flot.labels.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-flot/jquery.flot.resize.min.js') ?>"></script>

        <!--script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script-->
        <script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
        
        
        <!-- END JS PLUGIN -->

        <!-- BEGIN JS TEMPLATE -->
        <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
        
        <script src="<?php echo base_url('assets/js/skycons.js') ?>"></script>
        

        <script>
          var icons = new Skycons({"color": "white"}),
              list  = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
              ],
              i;

          for(i = list.length; i--; )
            icons.set(list[i], list[i]);

          icons.play();
        </script>
        
          <script>

    /* INLINE DATETIME */
            function initDatetime() {
                    $('#datetimepicker').datetimepicker({
                            startView: 2,
                            minView: 2
                    });
            }
            


              
	  $(function() {
		$("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' });
	  });
	  </script>

        <!-- END JS TEMPLATE -->
        
    </body>

</html>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title ?></title>

        <link rel="icon" href="<?php echo base_url('assets/img/url.ico'); ?>" > 

        <script src="<?php echo base_url('assets/js/jquery1.6.1.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>" >

    </head>

    <body class="skin-blue" style="background:#ffffff; ">

        <div class="wrapper row-offcanvas row-offcanvas-left" style="margin-left:40px;margin-right:40px;">
            <?php $this->load->view($content); ?>
        </div>

        <!-- <script src="<?php echo base_url('assets/plugins/jquery-2.1.0.min.js') ?>"></script> -->
        <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/plugins/icheck/icheck.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/main.js') ?>"></script>

    </body>

</html>
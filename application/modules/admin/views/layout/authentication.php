<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ;?></title>
        <base href="<?php echo site_url();?>">
        <link rel="icon" href="template/frontend/sis/favicon.ico" type="image/gif" sizes="16x16">
        <link href="template/frontend/sis/css/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="template/frontend/sis/css/bootstrap.min.css">
        <link rel="stylesheet" href="template/frontend/sis/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="template/frontend/sis/css/reponsive.css">
        <link rel="stylesheet" href="template/backend/default/css/login.css">
        <script src="template/frontend/sis/js/jquery.min.js" type="text/javascript"></script>
        <script src="template/frontend/sis/js/bootstrap.min.js"></script>
    </head>
    <body>
        <section class="itq-wrraper">
            <?php $this->load->view(isset($template)?$template:NULL);?>
        </section>
    </body>
</html>
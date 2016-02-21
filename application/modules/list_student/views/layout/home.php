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
        <link rel="stylesheet" href="template/frontend/sis/css/style.css">
        <link rel="stylesheet" href="template/frontend/sis/css/reponsive.css">
        <script src="template/frontend/sis/js/jquery.min.js" type="text/javascript"></script>
        <script src="template/frontend/sis/js/bootstrap.min.js"></script>
    </head>
    <body>
    <section class="wrapper">
        <!-header-->
        <header id= "header" class="container">
            <section class="top clearfix">
                <figure><img src="template/frontend/sis/images/sis_topbg.png"></figure>
                <!-form-->
                <form class="form-inline" role="form" action="" method="post">
                   <td class="cn"><a href="<?php echo site_url("list_class_of_teacher/home/logout");?>" class="btn btn-default" role="button">Đăng Xuất</a></td>      
                </form>
                <!-end form-->
            </section>
        
        </header> 
        <!-end header-->

        <!-Body-->
        <section id="body">
                <section class="container">
                  <?php isset($template)? $this->load->view($template):NULL;?>
                </section>
        </section>
        
</html>
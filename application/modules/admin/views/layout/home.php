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
        <link rel="stylesheet" href="template/backend/default/css/style.css">
        <script src="template/frontend/sis/js/jquery.min.js" type="text/javascript"></script>
        <script src="template/frontend/sis/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--header-->
        <header id= "header" class="itq-header">
            <p class="main-title">Hệ thống quản trị</p>
        </header> 
            <!--navigater-->
            <?php $this->load->view('admin/layout/navigation');?>
            <section class="itq-tabs">
                <h1><?php echo isset($tabs) ? $tabs:null;?></h1>
                <?php if(isset($navigation)&&is_array($navigation)&&count($navigation)) {?>
                <ul>
                    <li><a href="<?php echo isset($navigation) ? site_url($navigation['post']['link']) : null;?>"><?php echo isset($navigation) ? $navigation['post']['title'] : null;?></a></li>
                    <li><a href="<?php echo isset($navigation) ? site_url($navigation['add']['link']): null;?>"><?php echo isset($navigation) ? $navigation['add']['title'] : null;?></a></li>
                </ul>
                <?php } ?>
            </section>
        <!--Body-->
        <?php if(isset($template)) $this->load->view($template);?>
        <!--end Body-->
        <!--footer-->
        <?php $this->load->view('admin/layout/footer');?>
        <!--end footer-->
        <?php 
            $this->load->view('common/tinymce_3511');
            //(DEBUG == TRUE)?$this->output->enable_profiler(TRUE):'';
        ?>
    </body>
</html>
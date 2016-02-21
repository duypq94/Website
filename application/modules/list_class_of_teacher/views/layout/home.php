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
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                     <div class="form-group">
                        <label for="user">Chào <strong><?php echo $name['firstname'].' '.$name['lastname']?></strong></label>
                    </div>
                    <td class="cn"><a href="<?php echo site_url("list_class_of_teacher/home/logout");?>" class="btn btn-default" role="button">Đăng Xuất</a></td>      
                </form>
                <!-end form-->
            </section>
            <!-navigater-->
            <nav id="main-nav" class="navbar navbar-inverse navbar-static-top">
                <section class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </section>
                <section class="navbar-collapse collapse" id="menu">
                    <ul class="l1 nav navbar-nav">

                    
                        <li class="l1"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Lịch dạy
                            <span class="caret"></span></a>
                            <ul class="l2 dropdown-menu">
                                <li><a href="<?php echo site_url('list_class_of_teacher/home?semester=20152&')?>">Học kỳ 20152</a></li>
                                <li><a href="<?php echo site_url('list_class_of_teacher/home?semester=20151&')?>">Học kỳ 20151</a></li>
                                <li><a href="<?php echo site_url('list_class_of_teacher/home?semester=20142&')?>">Học kỳ 20142</a></li>
                                <li><a href="<?php echo site_url('list_class_of_teacher/home?semester=20141&')?>">Học kỳ 20141</a></li>

                            </ul>
                        </li>
                    </ul>
                </section>
            </nav><!-end navigate-->
        </header> 
        <!-end header-->

        <!-Body-->
        <section id="body">
                <section class="container">
                  <?php isset($template)? $this->load->view($template):NULL;?>
                </section>
        </section>
        <!-end Body-->
        <!-footer-->
        <footer id="footer">
            <section class="container">
                <section class="row">
                    <p class="title">Trang SIS phòng Đào tạo Đại học trường Đại học Bách Khoa Hà Nội </p>
                    <p class="name">Hanoi University of Science and Technology - No. 1, Dai Co Viet Str., Hanoi, Vietnam  </p>
                    <p class="name">Tel: (+844)38682305, (+844)38692008 - E-mail: <a class="mail" href="#">DTDH@mail.hust.edu.vn </a></p>
                </section>
            </section>
        </footer>
        <!-end footer-->
    </section>
    </body>
</html>
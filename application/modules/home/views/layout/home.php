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
        <header id= "header" class="container">
            <section class="top clearfix">
                <figure><img src="template/frontend/sis/images/sis_topbg.png"></figure>                   
            <?php if(isset($this->authentication)&&is_array($this->authentication)&&count($this->authentication))
                { ?>
                <div class="form-inline"> Xin Chào
                <strong><?php echo $this->authentication['FirstName'];echo "&nbsp"; echo $this->authentication['LastName']; ?></strong>
                <a href="<?php echo site_url('home/logout');?>">Log out</a>
                </div>
                <?php }
                else
                    {?>
                <form class="form-inline" role="form" action="" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                     <div class="form-group">
                        <label for="user">Tài khoản:</label>
                        <input type="text" class="form-control" id="name" name="id" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd" name="password" required="">
                    </div>
                    <button type="submit" class="btn btn-default" name="submit" value="Đăng nhập">Đăng nhập</button>
                </form>

                <?php } ?>
            </section>
            <?php $this->load->view('home/layout/navigation');?>
        </header> 
        <section id="body">
            <section class="container">
                <?php isset($template)? $this->load->view($template):NULL;?>
            </section>
        </section>
        <section id="footer">
            <section class="container">
                <section class="row">
                    <p class="title">Trang SIS phòng Đào tạo Đại học trường Đại học Bách Khoa Hà Nội </p>
                    <p class="name">Hanoi University of Science and Technology - No. 1, Dai Co Viet Str., Hanoi, Vietnam  </p>
                    <p class="name">Tel: (+844)38682305, (+844)38692008 - E-mail: <a class="mail" href="#">DTDH@mail.hust.edu.vn </a></p>
                </section>
            </section>
        </section>
    </section>
</body>
</html>
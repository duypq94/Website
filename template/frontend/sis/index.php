<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Demo sis</title>
        <link href="css/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/reponsive.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
    <section class="wrapper">
        <!-header-->
        <header id= "header" class="container">
            <section class="top clearfix">
                <figure><img src="images/sis_topbg.png"></figure>
                <!-form-->
                <form class="form-inline" role="form">
                     <div class="form-group">
                        <label for="email">Tài khoản:</label>
                        <input type="text" class="form-control" id="user">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <button type="submit" class="btn btn-default">Đăng nhập</button>
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
                        <li class="l1"><a href="">Trang chủ</a></li>
                        <li class="l1"><a href="">Thông tin ngưởi sử dụng</a></li>
                        <li class="l1"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kết quả học tập
                            <span class="caret"></span></a>
                            <ul class="l2 dropdown-menu">
                                <li><a href="#">Bảng điểm học phần</a></li>
                                <li><a href="#">Tra điểm </a></li>
                                <li><a href="#">Bảng điểm cá nhân</a></li> 
                            </ul>
                        </li>
                        <li class="l1"><a href="">Đăng ký học tập</a></li>
                        <li class="l1"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Chương trình đào tạo
                            <span class="caret"></span></a>
                            <ul class="l2 dropdown-menu">
                                <li><a href="#">Đăng ký lớp học</a></li>
                                <li><a href="#">Đăng ký học phần</a></li>
                                <li><a href="#">Xem lớp đăng ký</a></li> 
                            </ul>
                        </li>
                        <li class="l1"><a href="">Kế hoạch học tập</a></li>
                        <li class="l1"><a href="">Tra cứu</a></li>
                    </ul>
                </section>
            </nav><!-end navigate-->
        </header> 
        <!-end header-->

        <!-Body-->
        <section id="body">
                <section class="container">
                   <section id="home" class="row">
                        <header class="home">
                           <i class="fa fa-home"></i>
                           <span>Trang chủ</span>
                        </header>
                        <section class="col-md-8">
                            <section id="content">
                                <!-List_news-->
                                <article class="list_news">
                                    <header class="title">Lịch thi</header>
                                    <ul class="list">
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="pagination pagination-sm">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                    </ul>
                                </article>
                                <!-End List_news-->   
                                                                <!-List_news-->
                                <article class="list_news">
                                    <header class="title">Thong bao cua ban quan tri</header>
                                    <ul class="list">
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                        <li class="list clearfix">
                                            <i class="time"> 28/07/2015 05:45</i>
                                            <div class="link">
                                                <div class="clearfix"><a class="link" href="#">TB lịch thi kết thúc kỳ hè 20143</a></div>
                                                <div class="clearfix"><a class="description" href="#">SV vào xem lịch thi cuối kỳ học kỳ hè 20143</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="pagination pagination-sm">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                    </ul>
                                </article>
                                <!-End List_news-->   
                            </section>
                        </section>
                        <section class="col-md-4">
                            <aside id="hot_news">
                                <header class="title">10 tin mới nhất</header>
                                <ul class="list_news">
                                    <li class="link"><a href=""><i class="fa fa-bookmark"></i>TB Xử lý học tập kỳ 20142 (Chính thức)</a></li>
                                    <li class="link"><a href=""><i class="fa fa-bookmark"></i>TB Xử lý học tập kỳ 20142 (Chính thức)</a></li>
                                    <li class="link"><a href=""><i class="fa fa-bookmark"></i>TB Xử lý học tập kỳ 20142 (Chính thức)</a></li>
                                    <li class="link"><a href=""><i class="fa fa-bookmark"></i>TB Xử lý học tập kỳ 20142 (Chính thức)</a></li>
                                    <li class="link"><a href=""><i class="fa fa-bookmark"></i>TB Xử lý học tập kỳ 20142 (Chính thức) TB Xử lý học tập kỳ 20142 (Chính thức)</a></li>
                                </ul>
                            </aside>
                        </section>
                   </section>
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
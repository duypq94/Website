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
                        <!-- <li class="l1"><a href="">Thông tin ngưởi sử dụng</a></li>
                        <li class="l1"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kết quả học tập
                            <span class="caret"></span></a>
                            <ul class="l2 dropdown-menu">
                                <li><a href="#">Bảng điểm học phần</a></li>
                                <li><a href="#">Tra điểm </a></li>
                                <li><a href="#">Bảng điểm cá nhân</a></li> 
                            </ul>
                        </li> -->
                        <li class="l1"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Đăng ký học tập
                            <span class="caret"></span></a>
                            <ul class="l2 dropdown-menu">
                                <li><a href="<?php echo site_url('register_class/register');?>">Đăng ký lớp học</a></li>
                                <li><a href="<?php echo site_url('register_course/register');?>">Đăng ký học phần</a></li>
                                <li><a href="#">Xem lớp đăng ký</a></li> 
                            </ul>
                        </li>
                        <li class="l1"><a href="">Kế hoạch học tập</a></li>
                        <li class="l1"><a href="">Tra cứu</a></li>
                    </ul>
                </section>
            </nav><!--end navigate-->
            <nav class="navigation">
                <section class="navbar-collapse" id="menu">
                    <ul class="main">
                        <li class="main"><a class="main" href="<?php echo site_url('admin_system/system/index');?>">Hệ thống</a></li>
                       <!--  <li class="main"><a class="main" href="<?php echo site_url('admin_student/student/index');?>">Quản lý học sinh</a></li>
                        <li class="main"><a class="main" href="<?php echo site_url('admin_teacher/teacher/index');?>">Quản lý giảng viên</a></li> -->
                        <li class="main"><a class="main" href="<?php echo site_url('admin_course/course/index');?>">Quản lý môn học</a></li>
                        <li class="main"><a class="main" href="<?php echo site_url('admin_class/lop/index');?>">Quản lý lớp học</a>
                            <ul class="item">
                                <li class="item">
                                    <li class="item"><a class="item" href="<?php echo site_url('admin_class/lop/openclass');?>" title="Mở lớp">Mở lớp</a></li>
                                    <li class="item"><a class="item" href="<?php echo site_url('admin_class/lop/index');?>" title="Quản lý lớp">Quản lý lớp</a></li>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="user-account">
                        <li>Chào <strong><?php echo $this->authentication['fullname'];?></strong></li>
                        <li><a href="<?php echo site_url('admin/home/info');?>" title="Thông tin">Trang chủ</a></li>
                        <li><a href="<?php echo site_url("admin/home/logout");?>" title="Đăng xuất" onclick="return confirm('Are you sure?');">Đăng xuất</a></li>
                    </ul>
                </section>
            </nav><!-end navigate-->
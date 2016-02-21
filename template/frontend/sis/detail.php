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
	                        <input type="text" class="form-control" id="email">
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
	            <nav id="main-nav" class="navbar navbar-inverse">
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
	            </nav><!--end navigater-->
	        </header> 
	        <!-end header-->
	        <!-Body-->
	        <section id="body">
	        	<section class="container clearfix">
	        		<section id="list_table" class="row">
	        		<!--table-->
	        			<header class="home">
                         	<i class="fa fa-windows"></i>
                           	<span>Đăng ký lớp học</span>
                        </header>
                        <section class="detail">
                        	<div class="semester">
                        		<form class="form-inline" role="form">
                        			<label for="sel1">Học kỳ : </label>
									<select class="form-control" id="sel1">
									    <option>2015</option>
									    <option>2</option>
									    <option>3</option>
									    <option>4</option>
									</select>
                        		</form>
                        		<p>Chú ý: nên chọn trước các mã lớp phù hợp ở phần đăng ký học tập->danh sách lớp học trước để tiết kiệm thời gian.</p>
                        	</div>
                        	<div class="resgiter">
                        		<div class="form-inline">
  									<label for="pwd">Đăng ký mã lớp:</label>
  									<input type="password" class="form-control" id="pwd">
  									<button type="button" class="btn btn-default">Đăng ký</button>
								</div>
                        	</div>
                        </section>
		        		<section class="table_detail">
		        			<h4 class="title">Danh sách đăng ký lớp của sinh viên 20122163 học kỳ 20151</h4>
		        			<section class="table">
			        			<table class="table table-hover table-bordered">
				                    <thead>
				                        <tr>
				                            <th>Mã lớp</th>
				                            <th>Tên lớp</th>
				                            <th>Mã HP</th>
				                            <th>Loại lớp</th>
				                            <th>TT lớp</th>
				                            <th>Yêu cầu</th>
				                            <th>Trạng thái ĐK</th>
				                            <th>loại ĐK</th>
				                            <th><input type="checkbox" value=""></th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        <tr>
				                            <th>85767</th>
				                            <th>Hệ thống thông tin trên Web</th>
				                            <th>IT3402</th>
				                            <th>LT+BT</th>
				                            <th>Kết thúc ĐK</th>
				                            <th></th>
				                            <th>Thành công</th>
				                            <th>Online</th>
				                            <th><input type="checkbox" value=""></th>
				                        </tr>
				                        <tr>
				                            <th>85767</th>
				                            <th>Hệ thống thông tin trên Web</th>
				                            <th>IT3402</th>
				                            <th>LT+BT</th>
				                            <th>Kết thúc ĐK</th>
				                            <th></th>
				                            <th>Thành công</th>
				                            <th>Online</th>
				                            <th><input type="checkbox" value=""></th>
				                        </tr>
				                    </tbody>
			                	</table>
		                	</section>
		        		</section>
	        		<!-- end table-->
	        		</section>
	         	</section>
	        </section>
	        <!--end Body-->
	    </section>
    </body>
</html>
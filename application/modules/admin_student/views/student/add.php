
    			<section class="itq-form">
					<section class="main-panel clearfix">
						<header class="title">Thông tin chung</header>
						<form class="form-horizontal col-sm-7" role="form" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<section class="errol">
							</section>
							<div class="form-group">
								<label for="MaSV" class="col-sm-2 control-label">Mã SV</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="StCode" name="StCode" placeholder="Middle">
								</div>
							</div>
							<div class="form-group">
								<label for="Họ" class="col-sm-2 control-label">Họ đệm</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="middle" name="middle" placeholder="Middle">
								</div>
								<label for="Tên" class="col-sm-1 control-label">Tên</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="name" name="name" placeholder="Name">
								</div>
							</div>
							<div class="form-group">
								<label for="street" class="col-sm-2 control-label">Ngày sinh</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="street" name="street" placeholder="ngày sinh">
								</div>
							</div>
							<div class="form-group">
								<label for="country" class="col-sm-2 control-label">Quê quán</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="country" name="country" placeholder="Quê quán">
								</div>
							</div>
							<div class="form-group">
								<label for="zipcode"  class="col-sm-2 control-label">Lớp</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="zipcode" name="class" placeholder="Lớp">
								</div>
							</div>
							<div class="form-group">
								<label for="city" class="col-sm-2 control-label">Khoa</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="khoa" name="khoa" placeholder="Khoa">
								</div>
							</div>
							<div class="form-group">
								<label for="thao tac" class="col-sm-2 control-label">Thao tác</label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-default">Thêm mới</button>
									<button type="reset" class="btn btn-default">Làm lại</button>
								</div>								
							</div>
						</form>
					</section>
				</section>
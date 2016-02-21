
				<section class="itq-form">
					<section class="main-panel clearfix">
						<header class="title">Thông tin chung</header>
						<form class="form-horizontal col-sm-7" role="form" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<input type="hidden" name="id" value="<?php echo $semester['id'];?>"/>
							<section class="errol">
								<?php $error = validation_errors(); echo (isset($error) && !empty($error))?'<ul class="error">'.$error.'</ul>':''; ?>
							</section>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Học kỳ</label>
								<div class="col-sm-3">
									<p style="line-height: 30px;font-size: 15px;font-weight: bold"><?php echo $semester['name'];?></p>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Ngày mở</label>
								<div class="col-sm-4">
									<input type="date" class="form-control" name="start" required/>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Ngày ngày đóng</label>
								<div class="col-sm-4">
									<input type="date" class="form-control" name="end" required/>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Ghi chú</label>
								<div class="col-sm-6">
									<textarea name="comment" class="txtTextarea wysiwygEditor" id="txtDescription"><?php echo set_value('description',$comment);?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Thao tác</label>
								<div class="col-sm-6">
									<button type="submit" name="submit" value="thêm mới" class="btn btn-default">Lưu</button>
									<button type="reset" class="btn btn-default">Làm lại</button>
								</div>								
							</div>
						</form>
					</section>
				</section>
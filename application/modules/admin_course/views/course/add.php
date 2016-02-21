
    			<section class="itq-form">
					<section class="main-panel clearfix">
						<header class="title">Thông tin chung</header>
						<form class="form-horizontal col-sm-7" role="form" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
							<section class="errol">
								<?php $error = validation_errors(); echo (isset($error) && !empty($error))?'<ul class="error">'.$error.'</ul>':''; ?>
							</section>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Mã HP</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="CID" name="CID" placeholder="Mã Học Phần" required/>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Tên HP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="name" name="name" placeholder="Tên Học Phần" required/>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Số tín chỉ</label>
								<div class="col-sm-2">
									<input type="number" class="form-control" name="unit" min="1" max="6" step="1"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Khoa</label>
								<div class="col-sm-8">
									<?php echo form_dropdown('departid', $department, set_value('catalogueid', $catalogueid),'class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">HP Tiên quyết</label>
								<div class="col-sm-4">
									<div class="clearfix" id="requiment">
									</div>
									<div class="btn btn-default add"><i class="fa fa-plus"></i></div>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Mô tả</label>
								<div class="col-sm-8">
									<textarea name="description" class="txtTextarea wysiwygEditor" id="txtDescription"><?php echo set_value('description', '');?></textarea>
								</div>								
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Thao tác</label>
								<div class="col-sm-6">
									<button type="submit" name="submit" value="thêm mới" class="btn btn-default">Thêm mới</button>
									<button type="reset" class="btn btn-default">Làm lại</button>
								</div>								
							</div>
						</form>
					</section>
				</section>
				<script>
					$(document).ready(function() {
				    var max_fields      = 10; //maximum input boxes allowed
				    var wrapper         = $("#requiment"); //Fields wrapper
				    var add_button      = $(".add"); //Add button ID
				    
				    var x = 1; //initlal text box count
				    $(add_button).click(function(e){ //on add input button click
				        e.preventDefault();
				        if(x < max_fields){ //max input box allowed
				            x++; //text box increment
				            $(wrapper).append('<div><input style="margin-bottom:10px;width:80%;float:left" type="text" class="form-control" required name="requirement[]"><p class="remove_field" style="width:20%;float:left;padding: 10px; cursor:pointer;"><i class="fa fa-times"></i></p></div>'); //add input box
				        }
				    });
				    
				    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				        e.preventDefault(); $(this).parent('div').remove(); x--;
				    })
				});
				</script>



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
								<div class="col-sm-2">
									<input type="text" class="form-control" id="courseid" name="courseid" placeholder="Mã HP" required value='<?php if(isset($courseid)) echo $courseid;?>'>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Học kỳ</label>
								<div class="col-sm-2">
									<select name="semester" class="form-control"  >
										<?php foreach ($this->system['allsemeter'] as $key => $value) {
											if ($value['name']==$semester){
												echo '<option value="'.$value['name'].'"selected>'.$value['name'].'</option>';continue;
											}
											echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';

										}?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Số sinh viên</label>
								<div class="col-sm-2">
									<input type="number" class="form-control" id="max" name="max" placeholder="số sv" required value='<?php if(isset($courseid)) echo $courseid;?>'>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Giai đoạn</label>
									<div class="col-sm-2">
									<select name="stage" class="form-control">
										<option value="1">Kỳ A</option>
										<option value="2">Kỳ B</option>
										<option value="3">Cả kỳ</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">TKB</label>
								<div class="col-sm-10">
										<table class="table" id="timetable">
										    <thead>
										      <tr>
										        <th>Thứ</th>
										        <th>Buổi</th>
										        <th>Số tiết</th>
										        <th>Tiết bắt đầu</th>
										        <th>Phòng học</th>
										        <th>Thao tác</th>
										      </tr>
										    </thead>
										    <tbody>
										      <tr>
										        <td>
										        <?php for($i=2;$i<8;$i++){
										        	$day[$i] = $i;
										        }
										        echo form_dropdown('day[]',$day);
										        ?>
										        </td>
										        <td>
										        <?php
										       		$session[0] = 'Sáng';
										       		$session[1] = 'Chiều';
										       		echo form_dropdown('session[]',$session);
										       	?>								
										        </td>
										        <td>
										        <?php
										       		$total[2] = 2;
										       		$total[4] = 4;
										       		echo form_dropdown('total[]',$total);
										       	?>
											    </td>
										        <td>
										        <?php
										       		$start[1] = 1;
										       		$start[3] = 3;
										       		$start[5] = 5;
										       		echo form_dropdown('start[]',$start);
										       	?>
										        </td>
										        <td>
										        	<?php echo form_dropdown('area[]',$room);?>
										        </td>
										        <td class="delete"><p style="cursor:pointer"><i class="fa fa-times"></i></p></td>
										      </tr>
										    </tbody>
										</table>
										<div class="btn btn-default add">Thêm</div>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-2 control-label">Ghi chú</label>
								<div class="col-sm-8">
									<textarea name="comment" class="txtTextarea wysiwygEditor" id="txtDescription"><?php echo set_value('description', '');?></textarea>
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
						var $num ;
						$num = $("#timetable tbody tr:last").index();
						if($num == 0)
							$('.delete').css('display','none');
    					$('#timetable tbody').on("click",".delete", function(e){ //user click on remove text
    					$num = $( "#timetable tbody tr:last").index();
        				if($num > 0) {
        					$(this).parent('tr').remove();
        					$num --;
        					if($num == 0)
        						$('.delete').css('display','none');
        					}
    					})
    					$('.form-group').on("click",".add",function(e){
    						$temp = '<tr>'+ $( "#timetable tbody tr").html()+'</tr>';
    						$( "#timetable tbody").append($temp);
    						$num ++;
    						if($num>0){
    							$('.delete').css('display','block');
    						}
    					})
					});
				</script>
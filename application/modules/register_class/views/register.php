
        <section id="list_table" class="row">
            <header class="home">
                 <i class="fa fa-book"></i>
                <span>Đăng ký lớp học</span>
            </header>
                        <section class="detail">
                            <form class="form-inline" role="form"  method="post" action="">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>"/>                                    
                                <div class="semester">
                                    <label for="sel1">Học kỳ : </label>
                                    <select style ="padding: 0px 10px;height: 25px;"class="form-control" id="semester" name="semester">
                                   <?php foreach ($this->system['allsemeter'] as $key => $value){
                                            if ($value['name']==$semester){
                                                echo '<option value="'.$value['name'].'"selected>'.$value['name'].'</option>';continue;
                                            }
                                            echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                    }?>
                                    </select>
                                </div>
                                <div class="resgiter">
                                        <label for="sel1">Nhập mã HP </label>
                                        <input type="text" class="form-control" name="keyword" value ="<?php echo $keyword;?>" />
                                        <button type="submit" class="btn btn-default" name="submit" value="Tìm kiếm">Tìm kiếm</button>
                                </div>
                            </form>
                        </section>
            <?php if ($this->session->flashdata('msg')) { ?>
            <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <section class="table_detail">
            <h4 class="title">Học phần mở đăng ký</h4>
            <?php if (isset($search_result)&&is_array($search_result)&&count($search_result)){?>
                <section class="table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã lớp</th>
                                <th>Mã học phần</th>
                                <th>Tên học phần</th>
                                <th>Tuần học</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
                                <th>Max ĐK</th>
                                <!-- <th>Đã ĐK</th> -->
                                <th>Đăng ký</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($search_result)&&is_array($search_result)&&count($search_result)) {?>                        
                            <?php foreach ($search_result as $key => $value){
                                $timetable = timetable($value['timetable'],1);
                                $stage = week($value['stage']);
                                $number = $value['number'];
                            ?>
                            <tr>
                                <td><?php echo $value['classid']; ?></td>
                                <td><?php echo $value['courseid']; ?></td>
                                <td><?php echo $value['Name'];  ?></td>
                                <td><?php echo $stage;  ?></td>
                                <td><?php echo $timetable;?></td>
                                <td>Mở ĐK</td>
                                <td><?php echo $value['max'];  ?></td>
                                <!-- <td><?php if($value['status']==1) echo "Đã ĐK"; else echo "Chưa ĐK";?></td> -->
                                <td><?php echo $number;?></td>
                                <td>
                                    <a onclick="register(this)" classid ="<?php echo $value['classid']; ?>" status="<?php echo $value['status'];?>" id="registerBtn" url="<?php echo base_url("index.php/register_class/register/register_class");?>">
                                        <button class="btn">ĐK</button>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>        
                            <?php } ?> 
                        </tbody>  
                    </table>
                </section>  
                <?php } ?>
            </section>
            <section class="table_detail">
                 <h4 class="title">Lớp học bạn đã đăng ký</h4>
                <section class="table">
                    <table class="table table-bordered" id="registered_class_table">
                        <thead>
                            <tr>
                                <th>Mã lớp</th>                        
                                <th>Tên Lớp</th>
                                <th>Mã học phần</th>
                                <th>Trạng thái</th>
                                <th>Số Tín Chỉ</th> 
                                <th>Tuần học</th> 
                                <th>Thời gian</th>    
                                <th>Thao tác</th>                     
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($registered_class)&&is_array($registered_class)&&count($registered_class)) {?>   
                            <?php foreach ($registered_class as $key => $value) {
                                $MaHP = $value['CourseID'];
                                $TenHocPhan = $value['Name'];
                                $SoTinChi = $value['Unit'];
                                $SoTiet  = $value['SoTiet'];
                                $timetable = $value['timetable'];                 
                            ?>
                            <tr id="register-id-<?php echo $value['id'];?>">
                                <td><?php echo $value['classid']; ?></td>
                                <td><?php echo $value['Name'];  ?></td>
                                <td><?php echo $value['courseid']; ?></td>
                                <td>Thành công</td>                
                                <td><?php echo $value['Unit'];?></td>
                                <td><?php echo $value['stage'];?></td>
                                <td><?php echo $timetable;?></td>
                                <td>
                                    <a onclick="deleteClass(this)" classid ="<?php echo $value['classid']; ?>" registered-class-id="<?php echo $value['id']; ?>" url="<?php echo base_url("index.php/register_class/register/delete_class");?>">
                                        <button class="btn">Hủy ĐK</button>
                                    </a>
                                    <a target="blank" href="<?php echo site_url('register_class/register/detail/'.$value['classid']);?>">
                                        <button class="btn" style="margin-left:10px;">Chi tiết</button>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
<script type="text/javascript">
function register (el) {
    var semester = $("#semester option:selected").text();
    var url = $(el).attr("url");
    var classid = $(el).attr("classid");
    var delete_url = '<?php echo base_url("register_class/register/delete_class");?>';
    jQuery.ajax({
        url: url,
        cache: false,
        type: 'POST',
        data: {class_id : classid,semester_name:semester,'<?php echo $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash();?>'},
        dataType: 'html',
        success: function(data) {
            var register_result = jQuery.parseJSON(data);
            if(register_result.result == "failed"){
                alert(register_result.data);
            } else {
                alert("Đăng ký thành công");
                var html_code="";
                html_code += '<tr id="register-id-'+register_result.data[0].id+'">';
                html_code += '<th>'+register_result.data[0].classid+'</th>';
                html_code += '<th>'+register_result.data[0].Name+'</th>';
                html_code += '<th>'+register_result.data[0].courseid+'</th>';                
                html_code += '<th>Thành công</th>';                
                html_code += '<th>'+register_result.data[0].Unit+'</th>';
                html_code += '<th>'+register_result.data[0].stage+'</th>';
                html_code += '<th>'+register_result.data[0].timetable+'</th>';
                html_code += '<th class="cb">';
                html_code += '<a onclick="deleteClass(this)" classid ="'+register_result.data[0].classid+'" registered-class-id="'+register_result.data[0].id+'" url="'+delete_url+'">';
                html_code += '<button class="btn" type="button">Hủy ĐK</button></a>'
                html_code += '<a target="blank" href="register_class/register/detail/'+register_result.data[0].classid+'">';
                html_code += '<button class="btn" style="margin-left:10px;" type="button">chi tiết</button></a>'
                html_code += '</th></tr>';                             
                // alert(register_result.data[0].Name);
                $("#registered_class_table").append(html_code);
            }
        }
    });     
}
function deleteClass (el) {
    var semester = $("#semester option:selected").text();
    var url = $(el).attr("url");
    var classid = $(el).attr("classid");    
    var id = $(el).attr("registered-class-id");
    var delete_url = '<?php echo base_url("register_class/register/delete_class");?>';
    jQuery.ajax({
        url: url,
        cache: false,
        type: 'POST',
        data: {class_id : classid,semester_name:semester, id: id,'<?php echo $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash();?>'},
        dataType: 'html',
        success: function(data) {
            var register_result = jQuery.parseJSON(data);
            if(register_result.result == "failed"){
                alert(register_result.data);
            } else {
                 alert("Xóa lớp thành công");
                $("#register-id-"+id).remove();
            }
        }
    });     
}
</script>
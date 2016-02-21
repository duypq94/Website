<section class="itq-view">
    <section class="advanced">
        <section class="search">
            <form method="get" action="<?php echo site_url('admin_class/lop/index');?>">
                <input type="text" name="keyword" class="text" value="<?php echo (isset($keyword) && !empty($keyword))?htmlspecialchars($keyword):'';?>"/>
                <input type="submit" class="submit" value="Tìm kiếm" />
            </form>
        </section><!-- .search -->
    </section>
    <section class="main"><!-- .advanced -->
    <?php $message_flashdata = $this->session->flashdata('message_flashdata'); if(isset($message_flashdata) && count($message_flashdata)){ if($message_flashdata['type'] == 'successful'){ ?>
        <section class="notification notification-success"><?php echo $message_flashdata['message'];?></section>
    <?php } else if($message_flashdata['type'] == 'error'){ ?>
        <section class="notification notification-error"><?php echo $message_flashdata['message'];?></section>
    <?php } } ?>
    <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Mã Lớp</th>
            <th>Mã HP</th>
            <th>Học kỳ</th>
            <th>Tuần</th>
            <th>Max</th>
            <th>Số lượng sinh viên</th>
            <th>Thời gian</th>
            <th>Giáo viên</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
        <?php if(isset($cclass)&&is_array($cclass)&&count($cclass)){ ?>
        <?php foreach ($cclass as $key => $value) {
            $id = $value['id'];
            $classid = $value['classid']; 
            $courseid = $value['courseid'];
            $semester = $value['semester'];
            $stage = week($value['stage']);
            $max = $value['max'];
            $number = $value['number'];
            $timetable = timetable($value['timetable'],1);
            $lecturename = $value['lecturerid']!='' ? $lecturer[$value['lecturerid']]:'Chưa xếp giáo viên';
            
            ?>
          <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $classid;?></td>
            <td><?php echo $courseid;?></td>
            <td><?php echo $semester;?></td>
            <td><?php echo $stage;?></td>
            <td><?php echo $max;?></td>
            <td><?php echo $number;?><br><a href="<?php echo site_url('admin_student/student/index/'.$classid);?>">Xem danh sách</a></td>
            <td><?php echo $timetable;?></td>
            <td><?php echo $lecturename;?></td>
            <td><a title = 'xóa' href="<?php echo site_url('admin_class/lop/delete/'.$id)?>"><img src="template/backend/default/images/delete.png" onclick="return confirm('Are you sure you want to delete this item?');"/></a><a title = 'update' href="<?php echo site_url('admin_class/lop/update/'.$id)?>"><img src="template/backend/default/images/edit.png" /></a></td>
          </tr>
        <?php }}else{?>
            <tr>
                <td colspan="69" class="last">Không có dữ liệu</td>
            </tr>
           <?php }?>
        </tbody>
      </table>
  </section>
  <?php echo isset($list_pagination)?$list_pagination:'';?>
</section>
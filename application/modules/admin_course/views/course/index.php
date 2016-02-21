<section class="itq-view">
    <section class="advanced">
        <section class="search">
            <form method="get" action="<?php echo site_url('admin_course/course/index');?>">
                <input type="text" name="keyword" class="text" value="<?php echo (isset($keyword) && !empty($keyword))?htmlspecialchars($keyword):'';?>"/>
                <?php echo form_dropdown('departmentID', $department,set_value('departmentID',$departmentID), 'class="cbSelect"');?>
                <input type="submit" class="submit" value="Tìm kiếm" />
            </form>
        </section><!-- .search -->
        <!-- <section class="tool">
            <form method="post" action="">
                <input type="button" value="Xóa nhiều" onclick="if(confirm('Are you sure?')){document.getElementById('btnDelete').click()}" />
                <input type="button" value="Sắp xếp" onclick="document.getElementById('btnSort').click(); return false;" />
            </form>
        </section><!-- .tool -->
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
            <th>Mã HP</th>
            <th>Tên</th>
            <th>Số Tín Chỉ</th>
            <th>HP tiên quyết</th>
            <th>Ngày tạo</th>
            <th>Người tạo</th>
            <th>Khoa</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
        <?php if(isset($course)&&is_array($course)&&count($course)){ ?>
        <?php    foreach ($course as $key => $value){
                $ID = $value['ID'];
                $CID = $value['CourseID'];
                $name = $value['Name'];
                $unit = $value['Unit'];
                if($value['Requirement']){
                    $temp = json_decode($value['Requirement']);
                    $requirement = $temp[0];
                    foreach($temp as $key => $val){
                        if($key == 0) continue;
                        $requirement = $requirement.' , '.$val;
                    }
                }
                $created = date('d-m-Y',strtotime($value['created']));
                $user_created = $value['user_created'];
                $departmentID = (int)$value['DepartmentID'];
                $departmentName = $department[$departmentID];
            ?>
          <tr>
            <td><input type="checkbox" name="check[]" value="<?php echo $ID;?>" class="check-all" /></td>
            <td><?php echo $CID;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $unit;?></td>
            <td><?php echo $requirement;?></td>
            <td><?php echo $created;?></td>
            <td>Admin</td>
            <td><?php echo $departmentName;?></td>
            <td><a href="<?php echo site_url('admin_course/course/delete/'.$ID);?>" onclick="return confirm('Are you sure you want to delete this item?');" ><img src="template/backend/default/images/delete.png" /></a><a href="<?php echo site_url('admin_course/course/update/'.$ID);?>"><img src="template/backend/default/images/edit.png" /></a></td>
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
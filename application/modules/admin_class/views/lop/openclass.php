<section class="itq-view">
    <section class="advanced">
        <section class="search">
            <form method="get" action="<?php echo site_url('admin_class/lop/openclass');?>"/>
                <input type="text" name="keyword" class="text" value="<?php echo (isset($keyword) && !empty($keyword))?htmlspecialchars($keyword):'';?>"/>
               <?php echo form_dropdown('departmentID', $department,set_value('departmentID',$departmentID), 'class="cbSelect"');?>
                <input type="submit" class="submit" value="Tìm kiếm" />
            </form>
        </section>
    </section>
    <section class="main"><!-- .advanced -->
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Mã HP</th>
                <th>Tên HP</th>
                <th>Số lượng SV</th>
                <th>Kỳ</th>
                <th>Thao tác</th>
              </tr>
            </thead>
        <tbody>
        <?if(isset($course)&&is_array($course)&&count($course)){?>
            <?php foreach ($course as $key => $value){
                $cid = $value['cid'];
                $name = $value['name'];
                $number = $value['number'];
                $semester = $value['semester'];
            ?>
            <tr>
                <td><?php echo $key+1;?></td>
                <td><?php echo $cid;?></td>
                <td><?php echo $name;?></td>
                <td><?php echo $number;?></td>
                <td><?php echo $semester;?></td>
                <td>
                    <a href="<?php echo site_url('admin_class/lop/add/'.$cid);?>" class="btn btn-default btn-sm">Mở lớp</a>
                </td>
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
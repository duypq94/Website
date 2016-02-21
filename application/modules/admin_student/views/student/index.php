<section class="itq-view">
    <section class="main"><!-- .advanced -->
        <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>MSSV</th>
            <th>Họ đệm</th>
            <th>Tên</th>
            <th>Ngày sinh</th>
            <th>Hộ khẩu</th>
            <th>Lớp</th>
          </tr>
        </thead>
        <tbody>
        <?php if(isset($student)&&is_array($student)&&count($student)){
        foreach ($student as $key => $value) {
            $sid = $value['SID'];
            $firstname = $value['FirstName'];
            $lastname = $value['LastName'];
            $day = show_time($value['Birthday']);
            $lopname = $lop[$value['classid']];
            $addr = $value['Addres'] ;        
        ?>
          <tr>
            <td><?php echo $sid ;?></td>
            <td><?php echo $firstname ;?></td>
            <td><?php echo $lastname ;?></td>
            <td><?php echo $day ;?></td>
            <td><?php echo $addr;?></td>
            <td><?php echo $lopname ;?></td>
          </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
      </table>
  </section>
</section>
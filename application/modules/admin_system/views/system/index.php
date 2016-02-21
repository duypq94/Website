<section class="itq-view">
    <section class="main"><!-- .advanced -->
    <?php $message_flashdata = $this->session->flashdata('message_flashdata'); if(isset($message_flashdata) && count($message_flashdata)){ if($message_flashdata['type'] == 'successful'){ ?>
        <section class="notification notification-success"><?php echo $message_flashdata['message'];?></section>
    <?php } else if($message_flashdata['type'] == 'error'){ ?>
        <section class="notification notification-error"><?php echo $message_flashdata['message'];?></section>
    <?php } } ?>
        <table class="table table-bordered table-hover" style="width: 60%;margin: auto;margin-top: 30px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kỳ học</th>
                    <th>Thời gian</th>
                    <th>Đăng ký HP</th>
                    <th>Đăng ký lớp</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($semester)&&is_array($semester)&&count($semester)){?>
                <?php foreach ($semester as $key => $value) {
                    $id = $value['id'];
                    $name = $value['name'];
                    $time = show_time($value['start']).' - '.show_time($value['end']);
                    if($value['timehp']!=''){
                        $temp = json_decode($value['timehp'],TRUE);
                        $date=date_create($temp['start']);
                        $start = date_format($date,'d-m-Y');
                        $date=date_create($temp['end']);
                        $end = date_format($date,'d-m-Y');
                        $timehp = $start.' - '.$end;
                    }
                     if($value['timelh']!= ''){
                        $temp = json_decode($value['timelh'],TRUE);
                        $date=date_create($temp['start']);
                        $start = date_format($date,'d-m-Y');
                        $date=date_create($temp['end']);
                        $end = date_format($date,'d-m-Y');
                        $timelh = $start.' - '.$end;
                    }
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $time;?></td>
                    <?php if(isset($timehp)){?>
                    <td><?php echo $timehp;?><a title = 'update' href="<?php echo site_url('admin_system/system/opcourse/'.$id);?>"><img src="template/backend/default/images/edit.png" /></a></td>
                    <?php } else {?>
                        <td><a href="<?php echo site_url('admin_system/system/opcourse/'.$id);?>">Mở đăng ký</a></td>
                    <?php } ?>
                    <?php if(isset($timelh)){?>
                    <td><?php echo $timelh;?><a title = 'update' href="<?php echo site_url('admin_system/system/opclass/'.$id);?>"><img src="template/backend/default/images/edit.png" /></a></td>
                    <?php } else {?>
                        <td><a href="<?php echo site_url('admin_system/system/opclass/'.$id);?>">Mở đăng ký</a></td>
                    <?php } ?>
                </tr>
                <?php $timelh = $timehp = NULL;} ?>
              <?php } ?>
            </tbody>
        </table>
    </section>
</section>
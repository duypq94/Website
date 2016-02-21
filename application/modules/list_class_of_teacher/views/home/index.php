 <section id="home" class="row">
                        <header class="">
                           <i class="fa fa-home"></i>
                           <span>Danh sách lớp dạy học kỳ <?php echo $semester?></span>
                        </header>
                        <!--List_news-->
						
						
	<form class="form-inline" method="post" action="" role="form">
<!--
  <div class="form-group" style="width:100px;">
    <input type="email" class="form-control" id="email">
  </div>
  -->

                          <!--End List_news--> 
                                <!--List_news-->
<body>								
<div>
  <table class="table">
    <thead>
      <tr>
	  <th class="c2"></th>
    
        <th ><?php echo 'Danh sách lớp dạy của Giáo viên '.$id.' học kỳ '.$semester?></th>
         
      </tr>
    </thead>
	</table>
	</div>

<div>
    <!-- bang thu 1 -->
     <table class="table table-bordered">
	 <thead>
        <tr class="ab">
        <th>Mã lớp</th>
        <th class="tl">Tên lớp</th>
		<th>Mã HP</th>
		<th>Loại lớp</th>
		<th>TC</th>
		<th class="mt">danh sách SV</th>
		<th class="mt">Cập nhật mô tả</th>
      </tr>   
	  <thead>
   <tbody>
	    <?php
     if(isset($course) && count($course)){
  for($i=0;$i<count($course);$i++){
   $name = $course[$i]['Name'];
  
	$maHP = $class[$i]['courseid'];
	 $TC = $course[$i]['Unit'];
	$maLop = $class[$i]['classid'];
?>

	  <tr >
        <td><?php echo $maLop;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $maHP;?></td>
		<td>LT+BT</td>
        <td><?php echo $TC;?></td>
		
    <td><a class="link" href="<?php echo site_url('list_student/home?cid='.$maHP.'&semester='.$semester.'&')?>">Xem</a></td>
        
        <td class="cn"><a href="<?php echo site_url('class/home?hpid='.$maHP.'&lid='.$maLop.'&semester='.$semester.'&') ?>" class="btn btn-success btn-sm" role="button">Cập nhật</a></td>    	
      </tr>
<?php }} ?>



	</tbody>
   </table>
<div>
<div>
  <label><label></br>
 </div>
<div>
  <table class="table">
  
      <tr class="danger">
	  <th class="c2"></th>
        <th ><?php echo 'Lịch dạy trong tuần của Giáo viên '.$id.' học kỳ '.$semester?></th>     
      </tr>
	</table>
	</div>	
	<table class="table table-bordered"> 
	  <tr class="danger">
	    <td>Thứ</td>
        <td>Thời gian</td>
        <td>Tuần học</td>
        <td>Phòng học</td>
		<td>Mã HP</td>
        <td>Lớp học</td>
        <td>Loại lớp</td>		
      </tr>

       <?php
     if(isset($timetable) && count($timetable)){
  for($i=0;$i<(count($timetable)-1);$i++){
   
?>

    <tr class="">
        <td><?php echo $timetable[$i]['day']?></td>
    <td><?php echo $timetable[$i]['time']?></td>
        <td>2-9,11-18</td>
        <td><?php echo $timetable[$i]['area']?></td>
    <td><?php echo $class[$timetable[$i]['id']]['courseid'];?></td>
    <td><?php echo $class[$timetable[$i]['id']]['classid'];?></td>  
    <td>LT+BT</td>
      </tr>
<?php }} ?>	 
	 
	  </table>
	  
	</body>	
	
   
  
     
  	
	
					

						<!--End List_news-->   
                           
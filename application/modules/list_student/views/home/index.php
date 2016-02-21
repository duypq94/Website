 <section id="home" class="row">
                        <header class="">
                           <i class="fa fa-home"></i>
                           <span>Đăng Ký</span>
                        </header>
                        <!--List_news-->
						
						

<body>								
	<table class="table table-bordered"> 
	  <tr class="danger">
        <td>STT</td>
        <td>Họ và Tên</td>
		    <td>MSSV</td>
      </tr>
  <?php
  if(isset($student) && count($student)){
  for($i=0;$i<count($student);$i++){
   
?>
	  <tr class="">
        <td><?php echo $i+1?></td>
		    <td><?php echo $student[$i]['LastName'].' '.$student[$i]['FisrtName']?></td>
        <td><?php echo $stsid[$i]['sid']?></td>
      </tr>
<?php }} ?> 
<tr>
	 </tr> 
    </table>
      <label class="c3"></label>
  <a href="<?php echo 'list_class_of_teacher/home?semester='.$semester?>" class="btn btn-success btn-sm" role="button">Quay về danh sách lớp</a>
  </body>	
	
   
  
     
  	
	
					

						<!--End List_news-->   
                           
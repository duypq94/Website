<section id="list_table" class="row">
            <header class="home">
                 <i class="fa fa-book"></i>
                <span>Chi tiết khóa học</span>
            </header>
            <section class="table col-sm-3" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mục</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                        		<td>Mã lớp</td>
                        		<td><?php echo $lop['classid'];?></td>
                        	</tr>
                        	<tr>
                        		<td>Mã Học Phần</td>
                        		<td><?php echo $lop['courseid'];?></td>
                        	</tr>
                        	<tr>
                        		<td>Tên Học Phần</td>
                        		<td><?php echo $course['Name'];?></td>
                        	</tr>
                        	<tr>
                        		<td>số tín chỉ</td>
                        		<td><?php echo $course['Unit'];?></td>
                        	</tr>
                        	<tr>
                        		<td>Tuần học</td>
                        		<td><?php echo week($lop['stage']);?></td>
                        	</tr>
                        	<tr>
                        		<td>Buổi học</td>
                        		<td><?php echo timetable($lop['timetable'],1);?></td>
                        	</tr>
                            <tr>
                                <td>Giáo viên</td>
                                <?php if(isset($lecturer)){?>
                                <td>Name : <?php echo $lecturer['firstname'].' '.$lecturer['lastname'];?><br>
                                Email : <?php echo $lecturer['email'];?><br>
                                </td>
                                <?php }else echo "<td>Đang cập nhật</td>";?>
                            </tr>
                            <tr>
                                <td>Nội dung</td>
                                <?php if($lop['content']!=NULL){?>
                                <td>
                                <?php echo $lop['content'];?>
                                </td>
                                <?php }else echo "<td>Đang cập nhật</td>";?>
                            </tr>
                        </tbody>
                    </table>
            </section>
</section>
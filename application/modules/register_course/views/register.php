<section id="list_table" class="row">
                    <!--table-->
                        <header class="home">
                            <i class="fa fa-windows"></i>
                            <span>Đăng ký học phần</span>
                        </header>
                        <section class="detail">
                            <form class="form-inline" role="form"  method="post" action="">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>"/>                                    
                                <div class="semester">
                                    <label for="sel1">Học kỳ : </label>
                                    <select style ="padding: 0px 10px;height: 25px;"class="form-control" id="sel1" name="semester">
                                        <option>20152</option>
                                        <option>20151</option>
                                        <option>20142</option>
                                    </select>
                                </div>
                                <div class="resgiter">
                                        <label for="sel1">Nhập mã HP </label>
                                        <input type="text" class="form-control" name="keyword"/>
                                        <button type="submit" class="btn btn-default" name="submit" value="Tìm kiếm">Tìm kiếm</button>
                                </div>
                            </form>
                        </section>
                         <?php if ($this->session->flashdata('msg')) { ?>
                             <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
                         <?php } ?>
                         <?php if ($this->session->flashdata('msg2')) { ?>
                             <div class="alert alert-success"> <?= $this->session->flashdata('msg2') ?> </div>
                         <?php } ?>
            
                        <section class="table_detail">
                            <h4 class="title">Học phần mở đăng ký</h4>
                            <section class="table">
                                <table class="table table-bordered">
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
                                        <th>Đăng ký</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($course)&&is_array($course)&&count($course)){ ?>
                                    <?php    foreach ($course as $key => $value){
                                            $ID = $value['ID'];
                                            $CID = $value['CourseID'];
                                            $name = $value['Name'];
                                            $unit = $value['Unit'];
                                            if($value['Requirement']!=NULL){
                                                $temp = json_decode($value['Requirement']);
                                                $requirement = $temp[0];
                                                foreach($temp as $key => $val){
                                                    if($key == 0) continue;
                                                    $requirement = $requirement.' , '.$val;
                                                }
                                            }else $requirement = ' ';
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
                                        <td><a href="<?php echo site_url('/register_course/register/register_course/'.$CID);?>"><button class="button" type="btn btn-default">ĐK</button></a></td>
                                      </tr>
                                      <?php }}else{?>
                                        <tr>
                                            <td colspan="69" class="last">Không có dữ liệu</td>
                                        </tr>
                                       <?php }?>
                                    </tbody>
                                </table>
                            </section>
                        </section>
                        <section class="table_detail">
                            <h4 class="title">Danh sách học phần đã đăng ký</h4>
                            <section class="table">
                                <table class="table table-bordered">
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
                                        <th>Đăng ký</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($this->my_course)&&is_array($this->my_course)&&count($this->my_course)){ ?>
                                    <?php    foreach ($this->my_course as $key => $value){
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
                                        <td><a href="<?php echo site_url('/register_course/register/delete_registercourse/'.$ID);?>"><button class="button" type="btn btn-default">Hủy ĐK</button></a></td>
                                      </tr>
                                      <?php }}else{?>
                                        <tr>
                                            <td colspan="69" class="last">Không có dữ liệu</td>
                                        </tr>
                                       <?php }?>
                                    </tbody>
                                </table>
                            </section>
                        </section>
                    <!-- end table-->
                    </section>
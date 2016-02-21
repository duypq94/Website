
					<section id="home" class="row">
                        <header class="home">
                           <i class="fa fa-sign-in"></i>
                           <span>Đăng nhập</span>
                        </header>
                        <div class="col-md-4 col-md-offset-4">
					            <div class="panel panel-default">
					                <div class="panel-heading"> <strong class="">Login</strong>
					                </div>
					                <div class="panel-body">
					                	<div class="error">
					                		<?php echo validation_errors();?>
					                	</div>
					                    <form class="form-horizontal" role="form" method="post">
					                    	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>"/>
					                        <div class="form-group">
					                            <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
					                            <div class="col-sm-9">
					                                <input class="form-control" id="inputEmail" name="id" placeholder="User ID" required="" type="User ID">
					                            </div>
					                        </div>
					                        <div class="form-group">
					                            <label for="inputPassword3" class="col-sm-3 control-label">Mật Khẩu</label>
					                            <div class="col-sm-9">
					                                <input class="form-control" id="inputPassword3" name="password" placeholder="Mật Khẩu" required="" type="password">
					                            </div>
					                        </div>
					                        <div class="form-group">
					                            <label for="inputPassword3" class="col-sm-3 control-label">Capchar</label>
					                            <div class="col-sm-4">
					                                <img style="width:90%" src="<?php echo base_url('security/home/captcha');?>" class="imgCaptcha"/>
					                            </div>
					                            <div class="col-sm-5">
					                                <input class="form-control" id="captchatxt" name="capchar" required="">
					                            </div>
					                        </div>
					                        <div class="form-group">
					                            <div class="col-sm-offset-3 col-sm-9">
					                                <div class="checkbox">
					                                    <label class="">
					                                        <input class="" type="checkbox" name="remember">Duy trì đăng nhập</label>
					                                </div>
					                            </div>
					                        </div>
					                        <div class="form-group last">
					                            <div class="col-sm-offset-3 col-sm-9">
					                                <button type="submit" class="btn btn-success btn-sm" name="submit" value="Dang nhap">Đăng nhập</button>
					                                <button type="reset" class="btn btn-default btn-sm">Reset</button>
					                            </div>
					                        </div>
					                    </form>
					                </div>
					            </div>
					        </div>
                </section>
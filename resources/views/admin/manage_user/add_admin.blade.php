@extends('master-admin')
@section('content')
	<style>
		.content-header h2{
			font-weight: bold;
			text-align: center;
			color: red;
			text-shadow: 1px 2px black;
		}

		.content .form-group input{
			width: 70%;
		}

		.content .form-group select{
			width: 70%;
		}

		@media (min-width: 320px) and (max-width: 767px){
			.content .form-group input{
				width: 70%;
			}

			.content .form-group select{
				width: 70%;
			}

			
		}
		
	</style>

	<div class="content-wrapper" style="background-color: white;">
	    <section class="content-header">
	      	<h2>Thêm Tài Khoản Admin</h2>
	    </section>

    	<!-- Main content -->
    	<section class="content">
			<div class="panel panel-default">
				<div class="panel-body">
					
					<form action="{{ route('postAddAdmin') }}" enctype="multipart/form-data" method="POST" role="form" data-toggle="validator" novalidate="true">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Họ và tên</label>
									<input type="text" name="txt_name" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập tên admin">
									<div class="help-block with-errors"></div>
								</div>
							</div>
								
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Email</label>
									<input name="txt_email" type="text" class="form-control" id="" required="required" data-error="Vui lòng nhập email admin">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<h5>Mật khẩu:</h5>
									<div class="input-group input-file">		
							            <span class="input-group-btn">
							        		<button type="button" class="btn btn-info" id="button_create_pass" data-toggle="tooltip" title="Tạo mật khẩu đăng nhập">
		                                    <i class="fa fa-lock"></i>
		                                	</button>
							    		</span>
							    		<input type="text" minlength="8" maxlength="8" class="form-control" id="txt_mat_khau" name="txt_mat_khau" required="required" data-error="Vui lòng tạo mật khẩu">
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>

						</div>
					
						<div class="row" style="padding-top: 20px; padding-bottom: 10px;">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Số điện thoại</label>
									<input id="txt_sdt" name="txt_sdt" type="text" class="form-control" onblur="return Test_numberphone()" required="required" data-error="Vui lòng nhập số điện thoại">
									<div class="help-block with-errors"></div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Địa chỉ</label><br>
									<textarea name="txt_dia_chi" class="form-control" rows="3" required="required" data-error="Vui lòng nhập địa chỉ"></textarea>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Ảnh:</label>
									<input type="file" name="image" id="image" class="form-control" value="" required="required" data-error="Vui lòng thêm file hình">

									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
		
						<button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
					</form>
				</div>
			</div>
    	</section>
    	<!-- /.content -->
  </div>

	<script>

		function Test_numberphone(){
		    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
		    var mobile = $('#txt_sdt').val();
		    if(mobile !==''){
		        if (vnf_regex.test(mobile) == false) 
		        {
		            alert('Số điện thoại không đúng định dạng. Vui lòng nhập lại');
		        }
		    }
		}

		// Tạo tài mật khẩu đăng nhập
        function random_password_generate(max,min)
        {
            var UsernameChars = "0123456789QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm!@#$%&*";
            var randUNLen = Math.floor(Math.random() * (max - min + 1)) + min;
            var randUsername = Array(randUNLen).fill(UsernameChars).map(function(x){ 
                return x[Math.floor(Math.random() * x.length)] }).join('');
                return randUsername;
        }

        document.getElementById("button_create_pass").addEventListener("click", function()
            {
                random_username = random_password_generate(8,8);
                document.getElementById("txt_mat_khau").value = random_username;
            }
        );



    </script>
@stop
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset Pasword</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  	<link href='https://fonts.googleapis.com/css?family=Crete Round' rel='stylesheet'>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  	<style>
  		body{
			background: #f6f5f5;
  		}	

  		h1{
  			color: red;
  			text-shadow: 2px 2px 2px black;
  			font-weight: bold;
  		}
		
		.panel-title{
			text-align: center;
			font-weight: bold;
			color: #605f5f;
			font-size: 20px;
		}

  	</style>
</head>
<body>
	<br><br><br><br><br><br>
	<div class="row">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-md-push-3">
				<div style="text-align: center;">
					<h1>SmartPhone.com.vn</h1>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">ĐẶT LẠI MẬT KHẨU</h3>
					</div>

					<div class="panel-body">
									
						<form action="{{ route('postResetPassword')}}" 
							method="POST" role="form" data-toggle="validator" novalidate="true" >

							<input type="hidden" name="token" id="inputToken" class="form-control" value="$token">
			                
			                <div class="form-group">
			                  	<label for="">Nhập mật khẩu mới:</label>
			                  	<input style="width: 70%;" type="password" class="form-control" id="" name="txt_password" required="required" data-error="Vui lòng nhập mật khẩu mới">
			                  	<div class="help-block with-errors"></div>
			                </div>

			                <div class="form-group">
			                	<label for="">Xác nhận mật khẩu mới:</label>
			                  	<input style="width: 70%;" type="password" class="form-control" id="" name="txt_password_xn" required="required" data-error="Vui lòng xác nhận mật khẩu mới">
			                  	<div class="help-block with-errors"></div>
			                </div>
						                
			                <button type="submit"  class="btn btn-primary btn-block">Xác Nhận</button><br>
		              </form>
					</div>
				</div>
			</div> <!-- end col 6 -->

		</div> <!-- end container -->
	</div> <!-- end row -->
</body>
</html>
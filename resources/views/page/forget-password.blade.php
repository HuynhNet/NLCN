<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Forget Pasword</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  	<link href='https://fonts.googleapis.com/css?family=Crete Round' rel='stylesheet'>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<style>
  		body{
			background-color: #f6f5f5;
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
						@include('alert')
						<form action="{{ route('postForgetPassword') }}" method="POST" role="form">

			                {{ csrf_field() }}

			                <div class="form-group">
			                  <label for="">Địa chỉ email:</label>
			                  <input style="width: 70%;" type="text" class="form-control" id="" name="txt_email" placeholder="someone@gmail.com">
			                  <strong style="color: red;">{{ $errors->first('txt_emai') }}</strong>
			                </div>
						                
			                <button type="submit"  class="btn btn-primary btn-block">GỬI</button><br>
		              </form>
					</div>
				</div>
			</div> <!-- end col 6 -->

		</div> <!-- end container -->
	</div> <!-- end row -->
</body>
</html>
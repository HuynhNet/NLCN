<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  	<link href='https://fonts.googleapis.com/css?family=Crete Round' rel='stylesheet'>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  	<style>
  		h1{
            color: red;
            font-weight: bold;
            text-shadow: 1px 4px black;
        }

        .col-md-push-2 a{
            text-decoration: none;
            text-align: center;
        }

        .col-md-push-2 .panel-heading{
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            color: black;
        }
  	</style>
</head>
<body>
	<br><br><br><br><br>
	<div class="container">
		<div class="row">
	        <div class=" col-lg-8 col-md-push-2">
	        	<a href=""><h1>SmartPhone.com.vn</h1></a>
	            <div class="panel panel-default">
	                <div class="panel-heading">Đặt lại mật khẩu mới</div>

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST" action="{{ route('postResetPassword') }}" data-toggle="validator" novalidate="true">

	                        {{ csrf_field() }}

	                        <input type="hidden" name="token" value="{{ $token }}">

	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">Địa chỉ email</label>

	                            <div class="col-md-6">
	                                <input id="email" type="email" class="form-control" name="email"
	                                value="{{ $email or old('email') }}" required="required" data-error="Vui lòng nhập email">
	                                <div class="help-block with-errors"></div>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Nhập mật khẩu mới</label>

	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password" required="required" data-error="Vui lòng nhập mật khẩu mới">
	                                <div class="help-block with-errors"></div>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                            <label for="password-confirm" class="col-md-4 control-label">
	                                Xác nhận lại mật khẩu
	                            </label>

	                            <div class="col-md-6">
	                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="required" data-error="Vui lòng nhập mật lại khẩu mới">
	                                <div class="help-block with-errors"></div>
	                            </div>
							</div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary btn-block">
	                                    Đặt lại mật khẩu
	                                </button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>
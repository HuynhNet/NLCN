<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
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

        .col-md-offset-2 a{
            text-decoration: none;
            text-align: center;
        }

        .col-md-offset-2 .panel-heading{
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            color: black;
        }

    </style>
</head>
<body>
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
                <a href=""><h1>SmartPhone.com.vn</h1></a>
                <div class="panel panel-default">
                    <div class="panel-heading">Đặt lại mật khẩu</div>

                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" data-toggle="validator" novalidate="true" action="{{ route('getForgetPassword') }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <label for="email" class="col-md-4 control-label">Địa chỉ email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required="required" data-error="Vui lòng nhập email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">   
                                        Xác nhận
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

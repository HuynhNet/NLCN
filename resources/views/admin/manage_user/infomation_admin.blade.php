@extends('master-admin')
@section('content')
	<style>
		.content-header h2{
			font-weight: bold;
			text-align: center;
			color: red;
			text-shadow: 1px 2px black;
		}
		
		.content-header .navbar-right{
			padding-right: 18px;
			padding-bottom: 10px;
		}

		.content table th{
			font-size: 20px;
			font-weight: bold;
		}

		@media (min-width: 320px) and (max-width: 767px){
			.content img{
                width: 100%;
                height: 230px;
			}
			
		}
	</style>
	<div class="content-wrapper" style="background-color: white;">
	    <section class="content-header">
	      	<h2>Thông tin cá nhân</h2>
	    </section>
        
        @foreach($info as $val)
    	    <section class="content">
    	    	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <img src="{{ asset('public/upload/image_admin/'.$val->image) }}" class="img-responsive" 
                        alt="Image">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-top: 5px;">
                        <h4><p>Tên</p></h4>
                        <h4><p>Email</p></h4>
                        <h4><p>Phone</p></h4>
                        <h4><p>Địa chỉ</p></h4>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h4 style="color:#00604a;"><strong>{{ $val->name }}</strong></h4>
                        <h4><p>{{ $val->email }}</p></h4>
                        <h4><p>{{ $val->phone }}</p></h4>
                        <h4><p>{{ $val->address }}</p></h4>
                    </div>
                </div>
    	    </section>
        @endforeach
    	<!-- /.content -->
  </div>
@stop
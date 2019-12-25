@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				    <!-- Indicators -->
				    <ol class="carousel-indicators">
				    	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				       	<li data-target="#myCarousel" data-slide-to="1"></li>
				    </ol>

			      <!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
					    <div class="item active">
					        <img class="img-responsive" src="{{ asset('public/image/qc7.png') }}" alt="Image">    
					    </div>

			        	<div class="item">
					        <img class="img-responsive" src="{{ asset('public/image/qc4.gif') }}" alt="Image">     
				        </div>

				        <div class="item">
					        <img class="img-responsive" src="{{ asset('public/image/qc5.png') }}" alt="Image">     
				        </div>

				        <div class="item">
					        <img class="img-responsive" src="{{ asset('public/image/qc3.png') }}" alt="Image">     
				        </div>
				    </div>

			      	<!-- Left and right controls -->
			      	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				        <span class="sr-only">Previous</span>
			      	</a>
				      	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				        <span class="sr-only">Next</span>
			      	</a>
			    </div> <!-- end carousel -->
			</div> <!-- end col 8 -->

			<style>

				@media only screen and (max-device-width: 480px){
					.hinhphai{
						display: none;
					}
				}
			</style>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hinhphai">
				<div class="hover">
					<figure><img src="{{ asset('public/image/phai3.jpg') }}" class="img-responsive" alt="Image"></figure>
				</div>
				<div class="hover" style="padding-top: 7px;">
					<figure><img src="{{ asset('public/image/phai2.jpg') }}" class="img-responsive" alt="Image"></figure>
				</div>
			</div> <!-- end col 4 -->
		</div> <!-- end row -->
		
		<br>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img src="{{ asset('public/image/banner.jpg') }}" class="img-responsive" alt="Image">
			</div>
		</div>
	</div> 

	
	<style>
		.panel-default .box{
			transition: box-shadow .3s;
			background: #fff;
		}

		.panel-default .box:hover{
			box-shadow: 0 0 20px rgba(20,20,20,.2); 
		}

		.panel-default .panel-body a{
			text-decoration: none;
		}
		
		.panel-default .panel-body:hover a{
			color: red;
		}

	</style>
	<br><br>
	<div class="container noibat">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row ul">
						<h4 class="navbar-left">ĐIỆN THOẠI NỖI BẬT NHẤT</h4>
						<a href="{{ route('getViewAll','Phone') }}" class="navbar-right">Xem tất cả</a>
					</div>

					<div class="row">
						<div class="panel panel-default">
							<?php $stt=0; ?>
							@php($phone = DB::table('products')->where('id_type', 1)->get())
							@foreach($phone as $phones)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										<a href="{{ route('getViewProduct',$phones->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$phones->image) }}" class="img-responsive" alt="Image"></a><br>
										<a href="{{ route('getViewProduct',$phones->id) }}">{{ $phones->name }}</a><br>
										@if($phones->promotion_price == 0)
											<strong>{{ number_format($phones->price)  }} đ</strong>
										@else
											<strong class="navbar-left" style="text-decoration: line-through;">
												{{ number_format($phones->price)  }} đ</strong>
											<strong class="navbar-right">{{ number_format($phones->promotion_price)  }} đ</strong>
										@endif
									</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $phones->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$phones->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				</div> <!-- end col 12 -->
			</div> <!-- end container -->
		</div> <!-- end row -->
	</div>

	<br><br>
	<div class="container noibat">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row ul">
						<h4 class="navbar-left">LAPTOP NỖI BẬT NHẤT</h4>
							
						<a href="{{ route('getViewAll','Laptop') }}" class="navbar-right">Xem tất cả</a>

					</div>

					<div class="row">
						<div class="panel panel-default">
							<?php $stt=0; ?>
							@php($laptop = DB::table('products')->where('id_type', 2)->get())
							@foreach($laptop as $laptops)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										<a href="{{ route('getViewProduct',$laptops->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$laptops->image) }}" class="img-responsive" alt="Image"></a><br>
										<a href="{{ route('getViewProduct',$laptops->id) }}">{{ $laptops->name }}</a><br>
										@if($laptops->promotion_price == 0)
											<strong>{{ number_format($laptops->price) }} đ</strong>
										@else
											<strong class="navbar-left" style="text-decoration: line-through;">
												{{ number_format($laptops->price) }} đ</strong>
											<strong class="navbar-right">{{ number_format($laptops->promotion_price)  }} đ</strong>
										@endif
									</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $laptops->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$laptops->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				</div> <!-- end col 12 -->
			</div> <!-- end container -->
		</div> <!-- end row -->
	</div>

	<br><br>
	<div class="container noibat">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row ul">
						<h4 class="navbar-left">TABLET NỖI BẬT NHẤT</h4>
							
						<a href="{{ route('getViewAll','Tablet') }}" class="navbar-right">Xem tất cả</a>

					</div>

					<div class="row">
						<div class="panel panel-default">
							<?php $stt=0; ?>
							@php($tablet = DB::table('products')->where('id_type', 4)->get())
							@foreach($tablet as $tablets)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										
										<td class="td">
											<a href="{{ route('getViewProduct',$tablets->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$tablets->image) }}" class="img-responsive" alt="Image"></a><br>
											<a href="{{ route('getViewProduct',$tablets->id) }}">{{ $tablets->name }}</a><br>
											@if($tablets->promotion_price == 0)
												<strong>{{ number_format($tablets->price) }} đ</strong>
											@else
												<strong class="navbar-left" style="text-decoration: line-through;">
												{{ number_format($tablets->price) }} đ</strong>
											<strong class="navbar-right">{{ number_format($tablets->promotion_price)  }} đ</strong>
											@endif
										</td>
											
										</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $tablets->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$tablets->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				</div> <!-- end col 12 -->
			</div> <!-- end container -->
		</div> <!-- end row -->
	</div>
	
	<br><br>
	<div class="container noibat">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row ul">
						<h4 class="navbar-left">TAI NGHE NỖI BẬT NHẤT</h4>
							
						<a href="{{ route('getViewAll','Headphone') }}" class="navbar-right">Xem tất cả</a>

					</div>

					<div class="row">
						<div class="panel panel-default">
							<?php $stt=0; ?>
							@php($headphone = DB::table('products')->where('id_type', 3)->get())
							@foreach($headphone as $headphones)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										<a href="{{ route('getViewProduct',$headphones->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$headphones->image) }}" class="img-responsive" alt="Image"></a><br>
										<a href="{{ route('getViewProduct',$headphones->id) }}">{{ $headphones->name }}</a><br>
										@if($headphones->promotion_price == 0)
											<strong>{{ number_format($headphones->price) }} đ</strong>
										@else
											<strong class="navbar-left" style="text-decoration: line-through;">
											{{ number_format($headphones->price) }} đ</strong>
										<strong class="navbar-right">{{ number_format($headphones->promotion_price)  }} đ</strong>
										@endif
									</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $headphones->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$headphones->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				</div> <!-- end col 12 -->
			</div> <!-- end container -->
		</div> <!-- end row -->
	</div>
	<br><br>

	<script>

		var msg = '{{Session::get('add_cart_success')}}';
	    var exist = '{{Session::has('add_cart_success')}}';
	    if(exist){
	        swal({
	            title: "Đã thêm vào giỏ hàng",
	            text: "",
	            type: "success",
	            timer: 1200,
	            showConfirmButton: false,
	            position: 'top-end',
	        });
	    }

		var msg1 = '{{Session::get('register_success')}}';
	    var exist1 = '{{Session::has('register_success')}}';
	    if(exist1){
	        swal({
	            title: "Đã đăng ký tài khoản thành công.",
	            text: "",
	            type: "success",
	            timer: 1200,
	            showConfirmButton: false,
	            position: 'top-end',
	        });
	    }
	</script>
@stop
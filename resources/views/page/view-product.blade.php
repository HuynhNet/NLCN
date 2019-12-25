@extends('master')
@section('content')
	<div class="container">
		@foreach($product as $products)
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3>{{ $products->name }}</h3>
				<hr>
			</div>
		</div>
		
		<style>
			.hover figure img{
				-webkit-transform: scale(1);
				transform: scale(1);
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out;
			}
			.hover figure img:hover{
				-webkit-transform: scale(1.2);
				transform: scale(1.2);
			}
			
			@media only screen and (max-device-width: 480px){
			    .camket{
			        display: none;
			    }

			}
		</style>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
				<div class="hover">
					<figure><img src="{{ asset('public/upload/image_products/'.$products->image) }}" 
						class="img-responsive" alt="Image"></figure>
				</div>
			</div>
				
			<style>
				.gia .giamgia{
					text-decoration: line-through;
					padding-left: 20px;
					font-size: 16px;
				}
				.gia .price{
					font-size: 25px;
					font-weight: bold;
				}
				.gia .btn-danger{
					background: #d81111;
				}
				.gia .btn-primary{
					background: #1f3eae;
				}

			</style>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 gia">
				@if($products->promotion_price == 0)
					<p class="price">{{ number_format($products->price) }} đ</p><hr>
				@else
					<span class="price">{{ number_format($products->promotion_price) }} đ</span>
					<span class="giamgia">{{ number_format($products->price) }} đ</span>
					<hr>
				@endif
				<div class="panel panel-default">
					<div class="panel-body">
						{{ $products->describe }}
					</div>
				</div>

				<a href="{{ route('getBuyNow',$products->id) }}" class="btn btn-danger btn-block"><span style="font-size: 18px;">MUA NGAY</span> <br>
					SmartPhone sẽ gọi cho quý khách sớm nhất
				</a>
				<br>
				<a href="{{ route('getAddCart',$products->id) }}" class="btn btn-primary btn-block"><span style="font-size: 18px;">THÊM VÀO GIỎ HÀNG</span></a>
				<br>
				<p style="text-align: center; font-size: 15px;">Gọi <strong style="color: red;">1800-6601</strong> để được tư vấn mua hàng (Miễn phí)</p>
			</div>
			
			<style>
				.camket span{
					font-size: 25px;
				}
				.camket strong{
					color:red;
				}
				.camket i{
					font-size: 16px;
					color: red;
				}
				.camket p{
					font-size: 16px;
					font-weight: 500;
				}

			</style>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 camket">
				<span><strong>SmartPhone</strong> cam kết</span>
				<hr>
				<p><i class="fas fa-angle-double-right"></i> Hàng chính hãng</p>
				<p><i class="fas fa-angle-double-right"></i> Bảo hành 12 tháng chính hãng</p>
				<p><i class="fas fa-angle-double-right"></i> Giao hàng miễn phí trên toàn quốc</p>
			</div>
			
		</div> <!-- end row -->
		
		<style>
			#exTab2 .nav-tabs a{
			  	font-size: 16px;
			  	font-weight: 700;
			}

			#exTab2 .tab-pane .cycle-slideshow .panel-default .box{
				transition: box-shadow .3s;
				background: #fff;
			}

			#exTab2 .tab-pane .cycle-slideshow .panel-default .box:hover{
				box-shadow: 0 0 20px rgba(20,20,20,.2); 
			}

			#exTab2 .tab-pane .cycle-slideshow .panel-default .panel-body a{
				text-decoration: none;
			}
			
			#exTab2 .tab-pane .cycle-slideshow .panel-default .panel-body:hover a{
				color: red;
			}
		</style>
		<br><br><br>
		<div class="row">
			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs">
					<li class="active">
					    <a  href="#1" data-toggle="tab">Sản phẩm tương tự</a>
					</li>
					<li>
						<a href="#2" data-toggle="tab">Sản phẩm cùng hãng</a>
					</li>
				</ul>
				
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
				<div class="tab-content">
					<div class="tab-pane active" id="1">
						<div class="panel panel-default">
							<?php $stt=0; ?>
							@php($thesame = DB::table('products')->where('id_type', $id_type)->get())
							@foreach($thesame as $thesames)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										<a href="{{ route('getViewProduct',$thesames->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$thesames->image) }}" class="img-responsive" alt="Image"></a><br>
										<a href="{{ route('getViewProduct',$thesames->id) }}">{{ $thesames->name }}</a><br>
										@if($thesames->promotion_price == 0)
											<strong>{{ number_format($thesames->price) }} đ</strong>
										@else
											<strong class="navbar-left" style="text-decoration: line-through;">
												{{ number_format($thesames->price) }} đ</strong>
											<strong class="navbar-right">{{ number_format($thesames->promotion_price)  }} đ</strong>
										@endif
									</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $thesames->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$thesames->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div> <!-- tap-pane -->
			
					<div class="tab-pane" id="2">
					    <div class="panel panel-default">
							<?php $stt=0; ?>
							@php($thefirm = DB::table('products')->where('firm', $firm)->get())
							@foreach($thefirm as $thefirms)
							<?php $stt++; ?>
								@if($stt <= 4)
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
									<div class="panel-body">
										<a href="{{ route('getViewProduct',$thefirms->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$thefirms->image) }}" class="img-responsive" alt="Image"></a><br>
										<a href="{{ route('getViewProduct',$thefirms->id) }}">{{ $thefirms->name }}</a><br>
										@if($thefirms->promotion_price == 0)
											<strong>{{ number_format($thefirms->price) }} đ</strong>
										@else
											<strong class="navbar-left" style="text-decoration: line-through;">
												{{ number_format($thefirms->price) }} đ</strong>
											<strong class="navbar-right">{{ number_format($thefirms->promotion_price)  }} đ</strong>
										@endif
									</div>
									
									<div class="panel-footer">
										<a href="{{ route('getAddCart', $thesames->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
										<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$thesames->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				</div> <!-- tap-content -->
			</div>
		</div>
		<br><br>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div id="fb-root"></div>
				<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0"></script>

				<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#http://localhost/NLCN/view-product/{{ $products->id }}" data-width="500" data-numposts="5"></div>
			</div>
		</div>
		@endforeach
	</div> 
	<br><br><br>

	<script>
		var msg = '{{Session::get('add_cart_success')}}';
	    var exist = '{{Session::has('add_cart_success')}}';
	    if(exist){
	        swal({
	            title: "Đã thêm sản phẩm vào giỏ hàng.",
	            text: "",
	            type: "success",
	            timer: 1200,
	            showConfirmButton: false,
	            position: 'top-end',
	        });
	    }
	    
	    var msg1 = '{{Session::get('order_success')}}';
	    var exist1 = '{{Session::has('order_success')}}';
	    if(exist1){
	        swal({
	            title: "Đặt hàng thành công.",
	            text: "",
	            type: "success",
	            timer: 1200,
	            showConfirmButton: false,
	            position: 'top-end',
	        });
	    }

	    function xacnhanxoa(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		}
		
	</script>
@stop
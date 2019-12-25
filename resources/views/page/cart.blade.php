@extends('master')
@section('content')
	<br>
	<div class="container">
		@if(Session::has('cart'))
			<style>
				.has-cart .panel-body img{
					width: 100px;
					height: 100px;
				}
				.has-cart .navbar-right{
					padding-right: 15px;
				}
				.has-cart .navbar-right a{
					text-decoration: none;
				}
				.has-cart .panel-body .col-lg-1{
					padding-left: 0px;
					padding-right: 20px;
				}
			</style>
			<div class="row has-cart">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-2">
					<div class="navbar-left"> 
						<p>GIỎ HÀNG CỦA BẠN ({{Session('cart')->totalQty}} sản phẩm)</p>
					</div>

					<div class="navbar-right">
						<a href="">Mua thêm sản phẩm khác</a>
					</div>
					<br>
					<div class="panel panel-default">
						<div class="panel-body">
							@foreach($product_cart as $product)
							<div class="row">
								<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
									<img src="{{ asset('public/upload/image_products/'.$product['item']['image']) }}" class="img-responsive" alt="Image">
								</div>

								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<strong>{{ $product['item']['name'] }}</strong>
								</div>

								<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
									@if($product['item']['promotion_price'] == 0)
										<p>{{ number_format($product['item']['price']) }} đ</p>
									@else
										<p style="text-decoration: line-through;">
										{{ number_format($product['item']['price']) }} đ</p>
										<p>{{ number_format($product['item']['promotion_price']) }} đ</p>
									@endif
								</div>

								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<input style="width: 50%; margin-left: 30px; text-align: center;" type="number" id="txt_solg" value="{{$product['qty']}}" class="form-control quantity"
				                        onchange="update_cart({{ $product['item']['id'] }} + ',' + this.value)">
								</div>

								<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
									<a onclick="return xacnhanxoa('Ban co chac chan xoa?')" href="{{ route('getDeleteCart',$product['item']['id']) }}" class="btn btn-danger" data-toggle="tooltip" title="xóa">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</div>

							</div><hr> <!-- row -->
							@endforeach
							
							<style>
								.tinhtien p{
									color: red; 
									font-weight: bold;
									font-size: 16px;
								}

								.tinhtien strong{
									font-size: 16px;
								}
							</style>
							<div class="row tinhtien">
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									
								</div>
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 ">
									<strong>Tổng tiền: </strong>
								</div>
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<p>
										@if(Session::has('cart')){{number_format($totalPrice)}} đ
										@else 0 đ
										@endif
									</p>
								</div>
							</div> <hr>
							
							<style>
								.info-customer label{
									padding-top: 5px;

								}
								.info-customer .row .col-sm-7, .col-md-7  input:focus{
									outline: none;
								}
								.info-customer .row .col-sm-7, .col-md-7  input{
									
									border-color: inherit;
  									-webkit-box-shadow: none;
  									box-shadow: none;
  									border-width:0px;
									border:none;
									/*margin-top: 10px;*/

								}

								.info-customer button{
									width: 50%;
									margin-right: 40px; 
									height: auto;
									text-align: center;
									background-color: #d81111;
								}
								.info-customer button strong{
									font-size: 20px;
								}
							</style>
							<div class="row info-customer">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<h2><strong>Thông tin khách hàng</strong></h2>
									<br>
									<form action="{{ route('postCheckout') }}" method="POST" role="form" data-toggle="validator" novalidate="true" enctype="multipart/form-data">

										{{ csrf_field() }}

										@if(Auth::check())
	
										<div class="row thongtin">
											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Họ và tên: </label>
											</div>
											<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
												<input type="text" name="txt_name" class="form-control" id="" value="{{ Auth::user()->name }}">
											</div>
										</div>

										<div class="row">
											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Email: </label>
											</div>
											<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
												<input type="text" name="txt_email" class="form-control" id=""  value="{{ Auth::user()->email }}">
											</div>
										</div>

										<div class="row">
											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Số điện thoại: </label>
											</div>
											<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
												<input type="text" name="txt_phone" class="form-control" id=""  value="{{ Auth::user()->phone }}">
											</div>
										</div>

										<div class="row">
											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Đại chỉ: </label>
											</div>
											<div class="col-xs-7 col-sm7 col-md-7 col-lg-7">
												<input type="text" name="txt_address" class="form-control" id=""  value="{{ Auth::user()->address }}">
											</div>
										</div>

										<div class="row">
											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Hình thức thanh toán: </label>
											</div>
											<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
												<input type="text" name="txt_payment" class="form-control" id=""  value="Thanh toán khi nhận hàng">
											</div>
										</div>
										<br>
										@else
											<div class="form-group">
												<label for="">Họ và tên:</label>
												<input style="width: 50%;" type="text" name="txt_name" class="form-control" id="" placeholder="" required="required" data-error="Vui lòng nhập họ tên">
											</div>

											<div class="form-group">
												<label for="">Email:</label>
												<input style="width: 50%;" type="text" name="txt_email" class="form-control" id="" placeholder="" required="required" data-error="Vui lòng nhập email">
											</div>

											<div class="form-group">
												<label for="">Số điện thoại:</label>
												<input style="width: 50%;" type="text" name="txt_phone" class="form-control" id="" placeholder="" required="required" data-error="Vui lòng nhập số điện thoại">
											</div>

											<div class="form-group">
												<label for="">Địa chỉ:</label>
												<textarea style="width: 70%;" name="txt_address" class="form-control" rows="3" required="required" data-error="Vui lòng nhập địa chỉ"></textarea>
												<div class="help-block with-errors"></div>
											</div>

											<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
												<label for="">Hình thức thanh toán: </label>
											</div>
											<div style="font-weight: bold;" class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
												<input type="text" name="txt_payment" class="form-control" id=""  value="Thanh toán khi nhận hàng">
											</div>
											<br>
										@endif

										<button type="submit" class="btn btn-danger navbar-right">
										<strong>Xác nhận</strong><br>
										( SmartPhone sẽ gọi cho quý khách sớm nhất )
										</button>
									</form>
								</div>
							</div> {{-- row --}}


						</div>  <!-- panel-body -->
					</div> <!-- panel -->
				</div>
			</div> <!-- .ROW -->
		@else
		<style>
			.cart-null .panel-body{
				text-align: center;
			}
			.cart-null .panel-body i{
				color: #f44242;
				font-size: 40px;
			}
			.cart-null .panel-body a{
				padding: 15px 20px;
			}

			.cart-null .panel-body a:hover{
				background: white;
				color: red;
			}
		</style>
		<br>
			<div class="row cart-null">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h1><i class="fas fa-shopping-cart"></i></h1><br>
							<h4>Bạn không có sản phẩm trong giỏ hàng</h4><br>
							<a href="{{ route('getIndex') }}" class="btn btn-default">Quay về trang chủ</a>
						</div>
					</div>
				</div>
			</div>
			<br>
		@endif
	</div> 

	<script>
		var msg = '{{Session::get('delete_cart')}}';
	    var exist = '{{Session::has('delete_cart')}}';
	    if(exist){
	        swal({
	            title: "Đã xóa sản phẩm ra khỏi giỏ hàng.",
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

		function update_cart(e) {
		    var ele = e.split(",");
		    var ktra = document.getElementById('txt_solg').value;
		    if(ktra > 0){
		    	$.ajax({
	               url: '{{ route('getUpdateCart') }}',
	               method: "get",
	               data: {_token: '{{ csrf_token() }}',
	               id: ele[0],
	               quantity: ele[1]},
	               success: function (response) {
	               		swal({
						  title: "Đã cập nhật",
						  text: "",
						  type: "success",
						  timer: 900,
						  showConfirmButton: false,
						  position: 'top-end',
						});
	                   	window.setTimeout(function(){ 
						    location.reload();
						} ,900);
	               }
	            });
		    }else{
		    	document.getElementById('txt_solg').value = 1;
		    }
        };

		
	</script>
@stop
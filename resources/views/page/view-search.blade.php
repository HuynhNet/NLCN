@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<style>
				.product .panel-default .box{
					transition: box-shadow .3s;
					background: #fff;
				}

				.product .panel-default .box:hover{
					box-shadow: 0 0 20px rgba(20,20,20,.2); 
				}

				.product .panel-default .panel-body a{
					text-decoration: none;
				}
				
				.product .panel-default .panel-body:hover a{
					color: red;
				}

				.product .loaisanpham{
					padding-left: 10px;
					font-weight: bold;
					font-size: 20px;
				}
				.product .loaisanpham span{
					font-size: 15px;
					color: #696868;
					font-weight: 100;
				}
			</style>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product">
				<div class="row ul">
					<h4 class="navbar-left loaisanpham">
						<span>Tìm thấy <strong>{{ $sumProduct }}</strong> kết quả với từ khóa "<strong>{{ $name }}</strong>"</span>
					</h4>
				</div>
				<br>
				<div class="panel panel-default">
					@foreach($product as $products)
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
							<div class="panel-body">
								<a href="{{ route('getViewProduct',$products->id) }}"><img style="width: 150px; height:150px;" src="{{ asset('public/upload/image_products/'.$products->image) }}" class="img-responsive" alt="Image"></a><br>
								<a href="{{ route('getViewProduct',$products->id) }}">{{ $products->name }}</a><br>
								@if($products->promotion_price == 0)
									<strong>{{ number_format($products->price)  }} đ</strong>
								@else
									<strong class="navbar-left" style="text-decoration: line-through;">
										{{ number_format($products->price)  }} đ</strong>
									<strong class="navbar-right">{{ number_format($products->promotion_price)  }} đ</strong>
								@endif
							</div>
							
							<div class="panel-footer">
								<a href="{{ route('getAddCart', $products->id) }}" class="btn btn-primary" data-toggle="tooltip" title="thêm vào giỏ hàng"><i class="fa fa-shopping-cart"></i></a>
								<a style="margin-right: 4px;" class="btn btn-default navbar-right" href="{{ route('getViewProduct',$products->id) }}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="navbar-right" style="margin-right: 30px;">
				{{ $product->links() }}
			</div>
		</div>
		<br><br>
	</div> 

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
			
		function view_all_by_firm(e) {
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
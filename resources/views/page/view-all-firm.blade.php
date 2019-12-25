@extends('master')
@section('content')
	<br>
	<div class="container">
		<div class="row">
			<style>
				.product .loaisanpham{
					padding-left: 10px;
					font-weight: bold;
					font-size: 20px;
				}
				.product .loaisanpham span{
					font-size: 12px;
					color: #696868;
					font-weight: 100;
				}
			</style>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product">
				<h4 class="navbar-left loaisanpham">
					@if((is_array($id_type) || is_object($id_type)))
						@foreach($id_type as $value)
							{{ $value->type_name }} <span>({{ $sumProduct }} sản phẩm)</span>
							<input type="hidden" id="txt_type_product" name="" id="input" class="form-control" value="{{ $value->id }}">
						@endforeach
					@endif
				</h4>
			</div>
		</div>
		<br>

		<div class="row">
			<form action="{{ route('getViewAllSearch') }}" method="GET" role="form">
				{{ csrf_field() }}

				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 boLoc">
					<select name="txt_hang" id="txt_hang" class="form-control">
						<option value="">-- Chọn hãng --</option>
						@if(is_array($firm) || is_object($firm))
							@foreach($firm as $firms)
								<option class="option" value="{{ $firms->firm }}">
									{{ $firms->firm }}
								</option>
							@endforeach
						@endif
					</select>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<select name="txt_gia" id="txt_gia" class="form-control">
						<option value="">-- Chọn giá --</option>
						@if(is_array($id_type) || is_object($id_type))
							@foreach($id_type as $id_types)
								@php($id = $id_types->id)
							@endforeach
							@if($id == 1)
								<option value="0-3000">Dưới 3 triệu</option>
							    <option value="3000-6000">3-9 triệu</option>
							    <option value="9000-15000">9-15 triệu</option>
							    <option value="15000">Trên 15 triệu</option>
							    <input type="hidden" id="txt_id_type" name="txt_id_type" 
							    class="form-control" value="{{ $id }}">
						    @elseif($id == 2)
								<option value="5000">Dưới 5 triệu</option>
							    <option value="5000-10000">5-10 triệu</option>
							    <option value="10000-15000">10-15 triệu</option>
							    <option value="15000">Trên 15 triệu</option>
							    <input type="hidden" id="txt_id_type" name="txt_id_type"
							    class="form-control" value="{{ $id }}">
						    @elseif($id == 3)
						    	<option value="100">Dưới 100</option>
							    <option value="100-300">100-300</option>
							    <option value="300-500">300-500</option>
							    <option value="500">Trên 500</option>
							   	<input type="hidden" id="txt_id_type" name="txt_id_type" 
							    class="form-control" value="{{ $id }}">
						    @else
						    	<option value="0-3000">Dưới 3 triệu</option>
							    <option value="3000-6000">3-9 triệu</option>
							    <option value="9000-15000">9-15 triệu</option>
							    <option value="15000">Trên 15 triệu</option>
							    <input type="hidden" id="txt_id_type" name="txt_id_type" 
							    class="form-control" value="{{ $id }}">
						    @endif
					    @endif
					</select>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 navbar-right" style="margin-right: 1px;">
					<button id="btn_search" type="submit" class="btn btn-danger btn-block">Search</button>
				</div>
				
			</form>
		</div>
		<br><br>
		
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
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					@foreach($product as $products)
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 box">
							<div class="panel-body">
								<a href="{{ route('getViewProduct',$products->id) }}"><img style="width: 200px; height:200px;" src="{{ asset('public/upload/image_products/'.$products->image) }}" class="img-responsive" alt="Image"></a><br>
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
			

	     // $('#check').click(function(){
      //           var check= $(this).val();
      //           var id_type = document.getElementById('txt_type_product').val();
      //           $.ajax({
      //               url: '{{ route('getViewAllByFirmCheckbox') }}',
      //               type: 'GET',
      //               data:{
      //               	hang: check,
      //               	loai: id_type,
      //               },
      //               success: function(data){
                        
      //               }
      //           });
      //       });
		
	</script>

	<script>
		$(document).ready(function () {

		    var categories = [];
		    var id_type = document.getElementById('txt_type_product').val();
		    // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
		    document.getElementById('check').onclick = function(e){

		        e.preventDefault();
		        categories = []; // reset 

		        $('input[name="cat[]"]:checked').each(function()
		        {
		            categories.push($(this).val());
		        });

		        $.post('{{ route('getViewAllByFirmCheckbox') }}', {hang: categories, loai: id_type}, function(markup)
		        {
		            $('#search-results').html(markup);
		        });            

		    };

		});
	</script>
@stop
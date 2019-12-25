@extends('master')
@section('content')
	<br>
	<div class="container">
		<style>
			.loaisanpham{
				padding-left: 10px;
				font-weight: bold;
				font-size: 20px;
			}
			.loaisanpham span{
				font-size: 12px;
				color: #696868;
				font-weight: 100;
			}
		</style>
		<div class="row ul">
			<h4 class="navbar-left loaisanpham">
				@if(is_array($id_type) || is_object($id_type))
					@foreach($id_type as $value)
						{{ $value->type_name }} <span>({{ $sumProduct }} sản phẩm)</span>
					@endforeach
				@endif
			</h4>
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
			</style>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product">
				@if($sumProduct != 0)
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
				@else
					<h3 style="text-align: center;"><strong style="color: red;">SmartPhone.com</strong> không có sản phẩm như tìm kiếm </h3>
				@endif
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

        function search_if(){
        	var hang = document.getElementById('txt_hang').value;
        	var gia = document.getElementById('txt_gia').value;
        	var id_type = document.getElementById("txt_id_type").value;
    		$.ajax({
        		url: '{{ route('getViewAllSearch') }}',
        		method: 'GET',
        		data: {_token: '{{ csrf_token() }}',
        		hang: hang,
	            gia: gia,
	        	id_type: id_type},
        		success: function(response){
                   	alert("thanhcong");
               	}
        	});
        }



      //   function update_cart(e) {
		    // var ele = e.split(",");
		    // var ktra = document.getElementById('txt_solg').value;
		    // if(ktra > 0){
		    // 	$.ajax({
	     //           url: '{{ route('getUpdateCart') }}',
	     //           method: "get",
	     //           data: {_token: '{{ csrf_token() }}',
	     //           id: ele[0],
	     //           quantity: ele[1]},
	     //           success: function (response) {
	     //           		swal({
						//   title: "Đã cập nhật",
						//   text: "",
						//   type: "success",
						//   timer: 900,
						//   showConfirmButton: false,
						//   position: 'top-end',
						// });
	     //               	window.setTimeout(function(){ 
						//     location.reload();
						// } ,900);
	     //           }
	     //        });
		    // }else{
		    // 	document.getElementById('txt_solg').value = 1;
		    // }
      //   };
	</script>


	{{-- <script>
		$("#btn_search").click(function() {
			var hang = document.getElementById('txt_hang').value;
        	var gia = document.getElementById('txt_gia').value;
        	var id_type = document.getElementById("txt_id_type").value;
			alert(hang);

	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	        $.ajax({
	            type: 'GET',
	            url: '{{ route('getViewAllSearch') }}',
	            data: {
	                id_type: id_type,
	                hang: hang,
	                gia: gia
	            },
	            success: function(data) {
	               alert("thanhcong");
	            },
	            error: function(data) {
	                alert("loi");
	            }
	        });
	    });

		// $(document).ready(function() {
  //   		$.ajaxSetup({
		//         headers: {
		//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		//         }
		//     });
  //   		$('#btn_search').click(function(){
    			
  //   			$.ajax({
		//             type: 'GET',
		//             url: '{{ url('view-all-search') }}',
		            
		//             success: function(data) {
		//                 alert("thành công");
		//             },
		//             error: function(data) {
		//                 alert("lỗi");
		//             }
		//         });
  //   		});
		// });
	</script> --}}



@stop
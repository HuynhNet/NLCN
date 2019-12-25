@extends('master-admin')
@section('content')
	<style>
		.content-header h2{
			font-weight: bold;
			text-align: center;
			color: red;
			text-shadow: 1px 2px black;
		}

		.content .form-group input{
			width: 70%;
		}

		.content .form-group select{
			width: 70%;
		}

		@media (min-width: 320px) and (max-width: 767px){
			.content .form-group input{
				width: 70%;
			}

			.content .form-group select{
				width: 70%;
			}

			
		}
		
	</style>

	<div class="content-wrapper" style="background-color: white;">
	    <section class="content-header">
	      	<h2>Thêm Sản Phẩm Mới</h2>
	    </section>

    	<!-- Main content -->
    	<section class="content">
			<div class="panel panel-default">
				<div class="panel-body">
					
					<form action="{{ route('postAddProduct') }}" enctype="multipart/form-data" method="POST" role="form" data-toggle="validator" novalidate="true">

						{{ csrf_field() }}

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Tên sản phẩm</label>
									<input type="text" name="txt_name" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập nhập tên sản phẩm">
									<div class="help-block with-errors"></div>
								</div>
							</div>
								
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Loại sản phẩm</label>
									<select name="txt_type_product" class="form-control" 
									required="required" data-error="Vui lòng chọn loại sản phẩm">
										<option value="Phone">Phone</option>
										<option value="Laptop">Laptop</option>
										<option value="Headphone">Headphone</option>
										<option value="Tablet">Tablet</option>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Giá sản phẩm (VNĐ)</label>
									<input type="text" name="txt_price" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập giá sản phẩm" placeholder="2.100.000">
									<div class="help-block with-errors"></div>
								</div>
							</div>

						</div>
					
						<div class="row" style="padding-top: 20px; padding-bottom: 10px;">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Giá khuyến mãi (VNĐ)</label>
									<input type="text" name="txt_promotion_price" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập giá khuyến mãi" placeholder="Nhập 0 nếu không khuyến mãi">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label>Số lượng</label>
									<input type="text" name="txt_quantity" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập số lượng sản phẩm">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label for="">Ảnh sản phẩm</label>
									<input type="file" name="image" id="image" class="form-control" value="" required="required" data-error="Vui lòng thêm file hình">
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div> 

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<div class="form-group">
									<label>Hãng sản phẩm</label>
									<input type="text" name="txt_firm" class="form-control" value="" id="" required="required" data-error="Vui lòng nhập số lượng sản phẩm">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
								<div class="form-group">
									<label for="">Mô tả</label><br>
									<textarea name="txt_describe" class="form-control" rows="6" required="required" data-error="Vui lòng nhập địa chỉ"></textarea>
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
		
						<button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
					</form>
				</div>
			</div>
    	</section>
    	<!-- /.content -->
  </div>

	<script>
		var msg = '{{Session::get('add_product_success')}}';
	    var exist = '{{Session::has('add_product_success')}}';
	    if(exist){
	        swal({
	            title: "Đã thêm một sản phẩm mới.",
	            text: "",
	            type: "success",
	            timer: 1200,
	            showConfirmButton: false,
	            position: 'top-end',
	        });
	    }
    </script>
@stop
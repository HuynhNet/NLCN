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
			.content .table-customize th,td{
				padding-left: 0px;
			}
			
		}
	</style>
	<div class="content-wrapper" style="background-color: white;">
	    <section class="content-header">
	      	<h2>Quản lý sản phẩm</h2>
	    </section>

		<section class="content-header">

			<div class="navbar-left" style="padding-top: 15px; padding-right: 10px;">
	      		<button class="btn btn-danger delete_all" data-url="">Delete All Selected</button>

	      		<a href="{{ route('getAddProduct') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm</a>

                <a href="{{ route('getViewImportProduct') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm từ file excel</a>

                <a href="{{ route('getExportProduct') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Export User Data</a>

	      	</div>

			<form class="navbar-form navbar-right" role="search" method="GET"
                action="{{ route('getSearchProduct') }}">
				<div id="custom-search-input" style="padding-top: 8px;">
                    <div class="input-group">
                        <input type="text" name="txt_search" class="search-query form-control" placeholder="Nhập tên sản phẩm cần tiềm" / style="width: 300px;">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
			</form>
			
		</section>
		<br><br><br>

    	<!-- Main content -->
    	<section class="content">
			<table class="table table-bordered table-customize table-responsive table-hover">
			    <thead>
			        <tr>
			        	<th><input type="checkbox" id="master"></th>
			            <th>STT</th>
			            <th>Tên sản phẩm</th>
			            <th>Giá</th>
			            <th>Khuyến mãi</th>
			            <th>Hình ảnh</th>
			            <th>Số lượng</th>
			            <th>Hãng</th>
			            <th>Mô tả</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $stt=0; ?>
			    	@foreach($product as $val)
			    	<?php $stt++; ?>
			        <tr>
			        	<td><input type="checkbox" class="sub_chk" data-id="{{ $val->id }}"></td>
			            <td data-title="Numberical order">{{ $stt }}</td>
			            <td data-title="Product name">{{ $val->name }}</td>
			            <td data-title="Price">{{ $val->price }}</td>
			            <td data-title="Promotion">{{ $val->promotion_price }}</td>
			            <td data-title="Image">
			            	<img src="{{ asset('public/upload/image_products/'.$val->image) }}" class="img-responsive" alt="Image" style="width: 50px; height: 50px;">
			            </td>
						<td data-title="Quantity">{{ $val->quantity }}</td>
						<td data-title="Firm">{{ $val->firm }}</td>
						<td data-title="Describe">{{ $val->describe }}</td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>
    	</section>
    	<!-- /.content -->

    	<section class="content-header">
    		<div class="navbar-right">
    			{{ $product->links() }}
    		</div>
    	</section>
    	<br><br><br><br>
  </div>
  <script>

    var msg1 = '{{Session::get('delete_admin')}}';
    var exist1 = '{{Session::has('delete_admin')}}';
    if(exist1){
        swal({
            title: "Đã Xóa tài khoản.",
            text: "",
            type: "success",
            timer: 1200,
            showConfirmButton: false,
            position: 'top-end',
        });
    }

    var msg2 = '{{Session::get('eror')}}';
    var exist2 = '{{Session::has('eror')}}';
    if(exist2){
        swal({
            title: "Bạn cần đăng nhập tài khoản admin để thực hiện.",
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

  <script>
  		 $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Vui lòng chọn thành viên cần xóa");  
            }  else {  


                var check = confirm("Bạn có chắc xóa không?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: "{{ route('getDeleteAllMember') }}",
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                            });
                            alert('Đã xóa tất cả các tài khoản được chọn');
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: "{{ route('getDeleteAllMember') }}",
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Rất tiếc có lỗi xảy ra!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
  	</script>
@stop
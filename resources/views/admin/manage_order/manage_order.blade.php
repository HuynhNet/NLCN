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
	      	<h2>Quản lý hóa đơn</h2>
	    </section>

		<section class="content-header">

			<form class="navbar-form navbar-right" role="search" method="GET" 
                action="{{ route('getSearchOrder') }}">
				<div id="custom-search-input" style="padding-top: 8px;">
                    <div class="input-group">
                        <input type="text" name="txt_search" class="search-query form-control" placeholder="Nhập hóa đơn cần tiềm" / style="width: 300px;">
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
			            <th>STT</th>
			            <th>Tên khách hàng</th>
			            <th>Ngày đặt hàng</th>
			            <th>Hình thức thanh toán</th>
			            <th>Tổng tiền</th>
			            <th>Tự chọn</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $stt=0; ?>
			    	@foreach($bill as $val)
			    	<?php $stt++; ?>
			        <tr>
			            <td data-title="Numberical order">{{ $stt }}</td>
                        @php($ten = DB::table('customers')->where('id',$val->id_customer)
                            ->get())
                        @foreach($ten as $tens)
			                <td data-title="Customer name">{{ $tens->name }}</td>
                        @endforeach
			            <td data-title="Date order">{{ $val->date_order }}</td>
			            <td data-title="Thanh toán">{{ $val->payment }}</td>
			            <td data-title="Tổng tiền">{{ number_format($val->total) }} VNĐ</td>
						<td data-title="Tùy chọn" style="text-align: center;">
                            <a href="{{ route('getOrderDetail',$val->id) }}" class="edit-model btn btn-info" data-id="{{ $val->id }}" data-toggle="tooltip" title="Xem chi tiết">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                        </td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>

            {{-- <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Thông tin chi tiết đơn hàng</h4>
                        </div>

                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_edit" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="title">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Content:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content_edit" cols="40" rows="5"></textarea>
                                        <p class="errorContent text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                            </form>
                            <form action="" class="form-horizontal" role="form">
                                <table class="table table-bordered table-customize table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-title="" ><p id="ten_sp"></p></td>
                                            <td data-title="" ><p id="so_luong"></p></td>
                                            <td data-title="" ><p id="gia"></p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}
    	</section>
    	<!-- /.content -->

    	<section class="content-header">
    		<div class="navbar-right">
    			{{ $bill->links() }}
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

    {{-- <script>
        $(document).on('click', '.edit-model', function() {
            $('#ten_sp').val($(this).data('id'));
            $('#so_luong').val($(this).data('quantity'));
            $('#gia').val($(this).data('price'));
            $('#myModal').modal('show');
        });
    </script> --}}
@stop
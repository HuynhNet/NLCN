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
	      	<h2>Quản lý tài khoản thành viên</h2>
	    </section>

	    <section class="content-header">
	    	<div class="navbar-left" style="padding-top: 10px;">
	    		 <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{ url('delete-all-member') }}">Delete All Selected</button>

                 <a style="margin-bottom: 10px; margin-left: 10px;" href="{{ route('getimportExportView') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm user từ file excel</a>

                <a style="margin-bottom: 10px; margin-left: 10px;" href="{{ route('getExport') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Export User Data</a>
	    	</div>

	    	<form class="navbar-form navbar-right" role="search" method="GET" 
                action="{{ route('getSearchMember') }}">
				<div id="custom-search-input">
                    <div class="input-group">
                        <input name="txt_search" type="text" class="search-query form-control" placeholder="Nhập tên thành viên cần tìm" / style="width: 380px;">
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
			            <th>Họ tên</th>
			            <th>Email</th>
			            <th>Phone</th>
			            <th>Địa chỉ</th>
			            <th style="text-align: center;">Tùy chọn</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $stt=0; ?>
			    	@foreach($member as $val)
			    	<?php $stt++; ?>

			        <tr id="tr_{{ $val->id }}">
			        	<td><input type="checkbox" class="sub_chk" data-id="{{ $val->id }}"></td>
			            <td data-title="Numberical order">{{ $stt }}</td>
			            <td data-title="Full name">{{ $val->name }}</td>
			            <td data-title="Email">{{ $val->email }}</td>
			            <td data-title="Phone">{{ $val->phone }}</td>
			            <td data-title="Address">{{ $val->address }}</td>

			            <td data-title="Option" style="text-align: center;">
			            	<a href="" class="btn btn-info" data-toggle="tooltip" title="Xem chi tiết">
			            		<i class="glyphicon glyphicon-eye-open"></i>
			            	</a>
			            </td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>
    	</section>

		
    	<!-- /.content -->
  </div>
  <script>
  	var msg = '{{Session::get('delete_member')}}';
    var exist = '{{Session::has('delete_member')}}';
    if(exist){
        swal({
            title: "Đã xóa thành viên.",
            text: "",
            type: "success",
            timer: 1200,
            showConfirmButton: false,
            position: 'top-end',
        });
    }

    var msg1 = '{{Session::get('delete_all_member')}}';
    var exist1 = '{{Session::has('delete_all_member')}}';
    if(exist1){
        swal({
            title: "Đã xóa tất cả thành viên.",
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
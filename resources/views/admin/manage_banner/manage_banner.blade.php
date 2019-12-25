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
			
            .content .them{
                padding-top: 20px;
            }
		}
	</style>
	<div class="content-wrapper" style="background-color: white;">
	    <section class="content-header">
	      	<h2>Quản lý Banner</h2>
	    </section>

		<section class="content-header">

			<div class="navbar-left" style="padding-top: 15px; padding-left: 10px;">
	      		<button class="btn btn-danger delete_all" data-url="">Delete All Selected</button>
	      	</div>

			<form class="navbar-form navbar-right" role="search" method="GET" action="{{ route('getSearchBanner') }}">
				<div id="custom-search-input" style="padding-top: 8px; padding-right: 12px;">
                    <div class="input-group">
                        <input type="text" name="txt_search" class="search-query form-control" placeholder="Nhập tên banner cần tiềm" / style="width: 300px;">
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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <table class="table table-bordered table-customize table-responsive table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="master"></th>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0; ?>
                            @foreach($banner as $val)
                            <?php $stt++; ?>
                            <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="{{ $val->id }}"></td>
                                <td data-title="Numberical order">{{ $stt }}</td>
                                <td data-title="Image"><img style="width: 100px; height: 50px;" src="{{ asset('public/upload/image_banner/'.$val->image) }}" class="img-responsive" alt="Image"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end col 6 -->

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 them">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{ route('getAddBanner') }}" enctype="multipart/form-data" method="POST" role="form" data-toggle="validator" novalidate="true">
                                {{ csrf_field() }}

                                <h3 style="text-align: center;">Thêm Banner Mới</h3>
                                <div class="form-group">
                                    <label for="">File Banner</label>
                                    <input type="file" name="file" id="file" class="form-control" required="required" data-error="Vui lòng thêm file hình" onchange="readURL(this);">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <img style="width: 300px; height: 100px;" src="" id="viewimg" class="img-responsive" alt="Image">
                                </div>
                    
                                <button type="submit" class="btn btn-primary btn-block">UPLOAD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    	</section>
    	<!-- /.content -->

    	<section class="content-header">
    		<div class="navbar-right">
    			{{ $banner->links() }}
    		</div>
    	</section>
    	<br><br><br><br>
  </div>
  <script>

    var msg = '{{Session::get('add_banner_success')}}';
    var exist = '{{Session::has('add_banner_success')}}';
    if(exist){
        swal({
            title: "Đã thêm banner mới",
            text: "",
            type: "success",
            timer: 1200,
            showConfirmButton: false,
            position: 'top-end',
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewimg').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function() {
      readURL(this);
    });
    

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
                alert("Vui lòng chọn banner cần xóa");  
            }  else {  


                var check = confirm("Bạn có chắc xóa không?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: "{{ route('getDeleteAllBanner') }}",
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                            });
                            alert('Đã xóa tất cả các banner được chọn');
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
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
	      	<h2>Thêm Sản phẩm Từ File Excel</h2>
	    </section>

	    <section class="content-header">

            <br><br><br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-push-3">
                        <form action="{{ route('getImportProduct') }}" method="POST" role="form" enctype="multipart/form-data" data-toggle="validator" novalidate="true">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">File Excel:</label>
                                <input type="file" name="file_excel" id="file_excel" class="form-control" value="" required="required" data-error="Vui lòng thêm file excel">
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
	    </section>
	    <br><br><br>

    	<!-- Main content -->
    	<!-- /.content -->
  </div>
  <script>
  	var msg = '{{Session::get('add_product_excel')}}';
    var exist = '{{Session::has('add_product_excel')}}';
    if(exist){
        swal({
            title: "Đã thêm tất cả user từ file Excel.",
            text: "",
            type: "success",
            timer: 1200,
            showConfirmButton: false,
            position: 'top-end',
        });
    }

  </script>
@stop
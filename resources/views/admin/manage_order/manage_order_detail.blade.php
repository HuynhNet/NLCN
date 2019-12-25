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
	      	<h2>Chi tiết hóa đơn </h2>
	    </section>


    	<!-- Main content -->
    	<section class="content">
			<table class="table table-bordered table-customize table-responsive table-hover">
			    <thead>
			        <tr>
			            <th>STT</th>
                        <th>Tên sản phẩm</th>
			            <th>Số lượng</th>
			            <th>Giá</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $stt=0; ?>
			    	@foreach($bill_detail as $val)
			    	<?php $stt++; ?>
			        <tr>
			            <td data-title="Numberical order">{{ $stt }}</td>
                        @php($tensp = DB::table('products')->where('id',$val->id_product)
                            ->get())
                        @foreach($tensp as $tensps)
			                <td data-title="Product name">{{ $tensps->name }}</td>
                        @endforeach
			            <td data-title="Quantity">{{ $val->quantity }}</td>
			            <td data-title="Price">{{ number_format($val->price) }} VNĐ</td>
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
    			{{ $bill_detail->links() }}
    		</div>
    	</section>
    	<br><br><br><br>
  </div>

@stop
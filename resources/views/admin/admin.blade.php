@extends('master-admin')
@section('content')
	<div class="content-wrapper">
	    <section class="content-header">
	      	<h1>
	        	Bảng điều khiển
	      	</h1>
	    </section>

    	<!-- Main content -->
    	<section class="content">
      		<div class="row">
        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số thành viên</span>
			              	@php($user = DB::table('users')->where('id_level',3)->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $user }}</span>
			            </div>
		          </div>
        		</div>

        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-shopping-cart"></i></span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số đơn hàng</span>
			              	@php($bill = DB::table('bills')->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $bill }}</span>
			            </div>
		          	</div>
        		</div>

        		<!-- fix for small devices only -->
        		<div class="clearfix visible-sm-block"></div>

        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-menu-hamburger"></i></span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số sản phẩm cửa hàng</span>
			              	@php($product = DB::table('products')->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $product }}</span>
			            </div>
		          	</div>
        		</div>
      		</div>
			
			<br>
      		<div class="row">
        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-th-list"></i>
			            </span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số loại sản phẩm</span>
			              	@php($type_products = DB::table('type_products')->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $type_products }}</span>
			            </div>
		          </div>
        		</div>

        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-user"></i></span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số loại user</span>
			              	@php($type_user = DB::table('levels')->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $type_user }}</span>
			            </div>
		          	</div>
        		</div>

        		<!-- fix for small devices only -->
        		<div class="clearfix visible-sm-block"></div>

        		<div class="col-md-4 col-sm-6 col-xs-12">
		          	<div class="info-box">
			            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-user"></i></span>

			            <div class="info-box-content" style="text-align: center;">
			              	<span class="info-box-text">Tổng số khách hàng</span>
			              	@php($product = DB::table('products')->count())
			              	<span class="info-box-number" style="padding-top: 15px;">{{ $product }}</span>
			            </div>
		          	</div>
        		</div>
      		</div>
    	</section>
    	<!-- /.content -->
  </div>
@stop
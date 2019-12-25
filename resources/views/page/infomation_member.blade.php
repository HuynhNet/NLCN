@extends('master')
@section('content')
	<div class="container">
		<div class="row">
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
					.content img{
		                width: 100%;
		                height: 230px;
					}
					
				}
			</style>
			<div class="content-wrapper" style="background-color: white;">
			    <section class="content-header">
			      	<h2>Thông tin cá nhân</h2>
			    </section>
		        
		        @foreach($member as $val)
		    	    <section class="content">
		                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-2">
		                	<div class="panel panel-default">
		                		<div class="panel-body">
		                			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-top: 5px;">
				                        <h4><p>Tên</p></h4>
				                        <h4><p>Email</p></h4>
				                        <h4><p>Phone</p></h4>
				                        <h4><p>Địa chỉ</p></h4>
				                    </div>
				                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				                        <h4 style="color:#00604a;"><strong>{{ $val->name }}</strong></h4>
				                        <h4><p>{{ $val->email }}</p></h4>
				                        <h4><p>{{ $val->phone }}</p></h4>
				                        <h4><p>{{ $val->address }}</p></h4>
				                    </div>
		                		</div>
		                	</div>
		                    
		                </div>
		    	    </section>
		        @endforeach
		    	<!-- /.content -->
		  </div>
		</div> <!-- end row -->
		
	</div> 
	<br><br>
@stop
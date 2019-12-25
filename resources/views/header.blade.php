<style>
	.navbar-fixed-top{
		background: #c5c1c1;
	}

	.navbar-header .navbar-brand{
		color: red;
		text-shadow: 2px 2px 2px black;
		font-weight: bold;
		font-size: 24px;
	}

	.navbar-header .navbar-brand:hover{
		color: red;
		text-shadow: 2px 2px 2px black;
		font-weight: bold;
		font-size: 24px;
	}

	.navbar-ex1-collapse .navbar-nav .active:hover span{
		color: white;
	}

	.navbar-ex1-collapse .navbar-nav .active:hover a{
		background: black;
	}

	.navbar-ex1-collapse .navbar-nav li a {
		font-weight: bold;
		color: black;
	}

	.navbar-ex1-collapse .navbar-nav li a i{
		padding-right: 5px;
		font-size: 20px;
		color: black;
	}

	.navbar-ex1-collapse .hover li:hover{
		background: #008e8e;
	}

	.navbar-ex1-collapse .navbar-right li a .glyphicon-shopping-cart{
		font-size: 19px;
		padding-right: 10px;
	}

	.navbar-ex1-collapse .navbar-right li a .glyphicon-shopping-cart:hover{
		color: red;
	}
	
	@media (min-width: 320px) and (max-width: 767px){

		.navbar-ex1-collapse #custom-search-input input{
			width: 100px;
		}

	}
	 

</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('getIndex') }}">SmartPhone.com</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">

			<form class="navbar-form navbar-left" role="search" method="GET" action="{{ route('getSearch') }}">
				<div id="custom-search-input">
                    <div class="input-group">
                        <input name="txt_search" type="text" class="search-query form-control" placeholder="Nhập tên điện thoại, máy tính, phụ kiện ... cần tiềm" / style="width: 350px;" id="search">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit" id="btn_search">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
			</form>
			<script>
				$(document).ready(function() {
				  	$("#btn_search").click(function(e) {
					    e.preventDefault();
					    var name = document.getElementById('txt_search').value;
					    if(name == ' '){
				    		alert("Vui lòng nhập nội dung tìm kiếm!");
				    	}
				  	});
			</script>
			
			<ul class="nav navbar-nav navbar-right">

				<li class="nav-item dropdown no-arrow mx-1">
			        <a class="nav-link dropdown-toggle btn111" href="{{ route('getCart') }}" role="button" aria-haspopup="true" aria-expanded="false">

			          	<i class="fas fa-shopping-cart"></i>
			          	@if(Session::has('cart'))
			         		<span class="badge badge-danger" style="color: red; background: white; font-weight: bold;">{{Session('cart')->totalQty}}</span>
			         	@else 
							<span class="badge badge-danger" style="color: red; background: white; font-weight: bold;">0</span>
			         	@endif

			        </a>
			    </li> 

				@if(Auth::check()) 

		        <!-- <li>
		        	<div class="dropdown" style="padding-top: 10px; padding-right: 10px;">
		              	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
		                Xin chào:  <span class="caret"></span></button>
		              	<ul class="dropdown-menu" role="menu" aria-labelledby="menu">
		                	<li role="presentation"><a href="" role="menuitem">Đăng xuất</a></li>
		              	</ul>
		            </div>
		        </li> -->
					<li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="padding-top: 0px; width: 250px;">
                            <li class="user-header" style="height: 100px; background: #3f758b;text-align: center; padding-top: 20px;">
                                <p style="color: white; font-size: 18px;"> 
                                    {{ Auth::user()->name }} <br>
                                    <small>Thành viên từ năm 2019</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer" style="height: 50px; margin-top: 15px; margin-left: 10px; margin-right: 10px;">
                                <div class="pull-left">
                                    <a href="{{ route('getInfoMember', Auth::user()->id) }}" class="btn btn-success">Thông tin</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('getLogout') }}" class="btn btn-success">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
			    @else
					<a style="margin-top: 10px; margin-right: 10px;" class="btn btn-primary" href="{{ route('getRegister') }}" role="button">
			            <span class="glyphicon glyphicon-user"></span> Đăng ký</a>

			        <a style="margin-top: 10px; margin-right: 10px;" class="btn btn-primary" data-toggle="modal" href="{{ route('getLogin') }}" role="button"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
			    @endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

<style>
	.navbar2{
		padding-top: 50px;
	}

	.navbar2 .dropdown li {
		color: white;
	}

	.navbar2 .navbar-ex1-collapse{
		padding-left: 80px;
	}

	@media only screen and (max-device-width: 480px){
		.navbar2 .navbar-ex1-collapse{
		padding-left: 100px;
	}
	}
</style>

<nav class="navbar navbar-default navbar2" role="navigation">
	<div class="container-fluid">

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse" >
			<ul class="nav navbar-nav hover">
				
				<style>

					.dropdown .xoxuong{
						height: auto;
						padding-top: 10px;
						padding-bottom: 10px;
					}

					.dropdown .xoxuong li a{
						padding-top: 10px;
						padding-bottom: 10px;
						text-transform: uppercase;
					}

					.dropdown .xoxuong li a:hover{
						background-color: #424242;
						color: white;
					}

				</style>
				<li class="dropdown">
                  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-mobile-alt"></i> ĐIỆN THOẠI <span class="caret"></span></a>

                  	<ul class="dropdown-menu xoxuong">
                  		@foreach($firmPhone as $firmPhones)
	                    	<li><a href="{{ route('getViewAllByFirm',[1,$firmPhones->firm] ) }}">{{ $firmPhones->firm }}</a></li>
	                    @endforeach
                  	</ul>
                </li>

                <li class="dropdown">
                  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-laptop"></i> LAPTOP <span class="caret"></span></a>

                  	<ul class="dropdown-menu xoxuong">
                  		@foreach($firmLaptop as $firmLaptops)
	                    	<li><a href="{{ route('getViewAllByFirm',[2,$firmLaptops->firm]) }}">{{ $firmLaptops->firm }}</a></li>
	                    @endforeach
                  	</ul>
                </li>

                <li class="dropdown">
                  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-tablet"></i> TABLET <span class="caret"></span></a>

                  	<ul class="dropdown-menu xoxuong">
                  		@foreach($firmTablet as $firmTablets)
	                    	<li><a href="{{ route('getViewAllByFirm',[4,$firmTablets->firm]) }}">{{ $firmTablets->firm }}</a></li>
	                    @endforeach
                  	</ul>
                </li>

                <li class="dropdown">
                  	<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-headphones"></i> HEADPHONE <span class="caret"></span></a>

                  	<ul class="dropdown-menu xoxuong">
                  		@foreach($firmHeadphone as $firmHeadphone)
	                    	<li><a href="{{ route('getViewAllByFirm',[3,$firmHeadphone->firm]) }}">{{ $firmHeadphone->firm }}</a></li>
	                    @endforeach
                  	</ul>
                </li>
							
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>



	





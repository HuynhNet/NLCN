<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ADMIN</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css') }}">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/dist/css/AdminLTE.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('public/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
  	<link href="{{ asset('public/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  	<link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
  	
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	<style>
		body{
			font-family: arial;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	
	<div class="wrapper">
		
		@include('header-admin')
		
		@yield('content')
		
		@include('footer-admin')

	</div>

	<script src="{{ asset('public/AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('public/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('public/AdminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('public/AdminLTE/dist/js/adminlte.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('public/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap  -->
	<script src="{{ asset('public/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('public/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('public/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- ChartJS -->
	<script src="{{ asset('public/AdminLTE/bower_components/chart.js/Chart.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('public/AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('public/AdminLTE/dist/js/demo.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

	<script src="{{ asset('public/bootstrap-dropdown-hover-master/src/jquery.bootstrap-dropdown-hover.js') }}"></script>
	
	<script>
	      //$('[data-toggle="dropdown"]').bootstrapDropdownHover();
	      $.fn.bootstrapDropdownHover();
	      //$('#dropdownMenu1').bootstrapDropdownHover();
	      //$('.navbar [data-toggle="dropdown"]').bootstrapDropdownHover();
	    </script>
	
	<script>
	      // demo for realtime configuration and destroy
	      $('[data-toggle="tooltip"]').tooltip({container: 'body'});
	
	      $('#setSticky').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'sticky');
	      });
	
	      $('#setDefault').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'default');
	      });
	
	      $('#setDisable').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'disable');
	      });
	
	      $('#setLink').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'link');
	      });
	
	      $('#set1000').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setHideTimeout', 1000);
	      });
	
	      $('#set200').on('click', function () {
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setHideTimeout', 200);
	      });
	
	      $('#destroy').on('click', function () {
	        $('[data-toggle="tooltip"]').tooltip('hide');
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('destroy');
	        $('#destroy, #set200, #set1000, #setDisable, #setDefault, #setSticky').prop('disabled', 'disabled');
	        $('#reinitialize').prop('disabled', false);
	        $('.setdemo').addClass('destroyed');
	      });
	
	      $('#reinitialize').on('click', function () {
	        $('[data-toggle="tooltip"]').tooltip('hide');
	        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover();
	        $('#destroy, #set200, #set1000, #setDisable, #setDefault, #setSticky').prop('disabled', false);
	        $(this).prop('disabled', 'disabled');
	        $('.setdemo').removeClass('destroyed');
	      });
	</script>
</body>
</html>
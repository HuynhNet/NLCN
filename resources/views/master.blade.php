<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	
	<link rel="stylesheet" href="{{ asset('public/css/footer.css') }}">
	<link rel="stylesheet" href="{{ asset('public\css\header.css') }}">
	<link rel="stylesheet" href="{{ asset('public\css\content1.css')}}">
  	<link rel="stylesheet" href="{{ asset('public\css\noibat.css') }}">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	<script src="https://malsup.github.io/min/jquery.cycle2.min.js"></script>
	<script src="https://malsup.github.io/min/jquery.cycle2.carousel.min.js"></script>
  	
</head>

<body>
	@include('header')
	

	@yield('content')

	@include('footer')

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
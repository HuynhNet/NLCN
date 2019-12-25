<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
		@if(session('status'))
			<div id="alert-success" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>{{ session('status') }}</strong>
			</div>
		@endif
	</div>
</div>
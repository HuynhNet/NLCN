<h1>Hello {{ $user->name }}</h1>
<br>
<p>Please click the password reset button to reset your password
	<a href="{{ url('reset-password/' .$user->email) }}">Reset password</a>
</p>
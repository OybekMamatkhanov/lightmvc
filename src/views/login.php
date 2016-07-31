<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/30/2016
 * Time: 3:42 AM
 */
?>

<div class="conteiner">
	<form action="/sign" method="post" class="form-signin">
		<h2 class="form-signin-heading">Please sign in</h2>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="e-mail/username" required="" autofocus="">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="password" required="">
		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div>

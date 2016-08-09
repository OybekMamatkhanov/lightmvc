<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/30/2016
 * Time: 3:42 AM
 */
use Src\Core\Language;
use Src\Core\Session;
?>

<div class="container">

	<form action="/user/login" method="post" class="form-signin">
		<h1></h1>
		<?php if ( Session::hasFlash() ) :?>
			<div class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span><strong> Error! <?php Session::flash();?> </strong></div>
		<?php endif;?>
		<h2 class="form-signin-heading"><?=Language::get('login')?></h2>
		<label for="inputEmail" class="sr-only"><?=Language::get('email')?></label>
		<input type="email" id="inputEmail" class="form-control" placeholder="<?=Language::get('email')?>" required="" autofocus="" name="email">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="<?=Language::get('password')?>" required="" name="password">
		<!--<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me" name="remember"><?=Language::get('remember')?>
			</label>
		</div>-->
		<button class="btn btn-lg btn-primary btn-block" type="submit"><?=Language::get('login')?></button>
	</form>
</div>

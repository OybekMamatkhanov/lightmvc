<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/30/2016
 * Time: 4:17 PM
 */
use Src\Core\Session;
use Src\Core\Language;
?>


	<form enctype="multipart/form-data" action="/user/signup" method="post" class="form-signin">
		<h1></h1>
		<?php if ( Session::hasFlash() ) :?>
			<div class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span><strong> Error! <?php Session::flash();?> </strong></div>
		<?php endif;?>
		<h2 class="form-signin-heading"><?=Language::get('register')?></h2>
		<label for="inputEmail" class="sr-only">Username</label>
		<input type="text" id="inputEmail" class="form-control" placeholder="<?=Language::get('username')?>" required="" autofocus="" name="username">
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="<?=Language::get('email')?>" required="" autofocus="" name="email">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="<?=Language::get('password')?>" required="" name="password">
		<label for="inputPassword" class="sr-only">Choose photo</label>
		<input type="file" id="inputFile" class="form-control" required="" placeholder="<?=Language::get('file')?>" name="image">
		<button class="btn btn-lg btn-primary btn-block" type="submit"><?=Language::get('signup')?></button>
	</form>

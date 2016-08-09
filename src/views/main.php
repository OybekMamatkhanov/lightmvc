<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 8:00 PM
 */
use Src\Core\Language;
use Src\Core\Session;
use Src\Core\App;
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="/signin.css" type="text/css"/>
	<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css">
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/assets/js/main.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><?=Language::get('home')?></a>
			<ul class="nav navbar-nav">
				<li>
					<a href="/user/contact">Contact</a>
				</li>
				<li>
					<?php if ( Session::get('role') == 1 ) :?>
						<a href="/site/admin">Admin</a>
					<?php endif;?>
				</li>
			</ul>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php if ( !Session::get('username') ) :?>
					<li><a href="/site/signin"><?=Language::get('login')?></a></li>
					<li><a href="/site/signup"><?=Language::get('signup')?></a></li>
				<?php elseif ( Session::get('username') ) : ?>
					<li><a href="/user/profile"><?=Language::get('profile')?></a></li>
					<li><a href="/user/logout"><?=Language::get('logout')?></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>
	<div class="container">
		<?php include 'src/views/'.$view . '.php'; ?>
	</div>
</body>
</html>

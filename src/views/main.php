<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 8:00 PM
 */
use Src\Core\Language;
use Src\Core\Session;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
	<link rel="stylesheet" href="/signin.css" type="text/css"/>
	<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css"/>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><?=Language::get('home')?></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php if ( !Session::get('username') ) :?>
					<li><a href="/site/signin"><?=Language::get('login')?></a></li>
					<li><a href="/site/signup"><?=Language::get('signup')?></a></li>
				<?php elseif ( Session::get('username') ) : ?>
					<li><a href="/user/logout"><?=Language::get('logout')?></a></li>
				<?php endif; ?>
			</ul>
		</div>

		<!--<div class="test">

			<?php if (Session::hasFlash() ) :?>
				<div class="alert alert-info" role="alert">
					<?php Session::flash(); ?>
				</div>
			<?php endif; ?>
		</div>-->
	</div>
</nav>
<?php include 'src/views/'.$view . '.php'; ?>
</body>
</html>

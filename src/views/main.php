<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 7/14/2016
 * Time: 8:00 PM
 */
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
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/site/signin">Log In</a></li>
				<li><a href="/site/signup">Sign Up</a></li>
			</ul>
		</div>
	</div>
</nav>
<?php include 'src/views/'.$view . '.php'; ?>
</body>
</html>

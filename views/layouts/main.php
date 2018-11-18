<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/style.css">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header>
	<div>
		<ul>
			<li><a href="/catalog">Каталог</a></li>
			<li><a href="/cart">Корзина</a></li>
			<li><a href="/user">Личный кабинет</a></li>
			<li><a href="/catalog/modify">Работа с товарами</a></li>
		</ul>
	</div>
</header>
<section class="content">
	<?= $content ?>
</section>
<footer>
	<br>
	<br>
	-== FOOTER ==-
</footer>
</body>
</html>
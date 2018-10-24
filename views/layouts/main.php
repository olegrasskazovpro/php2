<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		.catalog-div {
			display: flex;
			flex-wrap: wrap;
		}

		.single {
			display: block;
		}

		.img__single {
			width: 300px;
			height: 200px;
		}
		.card {
			width: 200px;
			margin: 15px;
		}

		img {
			height: 100%;
		}

		a {
			text-decoration-line: none;
		}

		h2, h3 {
			font-family: "Open Sans";
			color: #2f2f2f;
		}

		h3 {
			color: rebeccapurple;
		}

		ul {
			display: flex;
		}

		li {
			padding: 10px;
			list-style-type: none;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header>
	-== HEADER ==-
</header>
<section class="content">
	<?=$content?>
</section>
<footer>
	-== FOOTER ==-
</footer>
</body>
</html>
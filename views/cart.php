<?php /** @var \app\models\Cart $cart */?>

<h1>Cart</h1>

<div class="catalog-div">
		<div class="cart">
			<a href="./?c=product&a=card&id=<?= $cart['id'] ?>" class="single">
				<h2><?= $cart['title'] ?></h2>
			</a>
			<p><?= $cart['desc'] ?></p>
			<h3>Цена: <?= $cart['price'] ?> руб.</h3>
			<form action="" method="post">
				<button name="id" value="<?= $cart['id']?>">Delete from cart</button>
			</form>
		</div>
</div>
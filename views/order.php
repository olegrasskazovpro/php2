<?php /** @var \app\models\Cart $cart */?>

<h1>Ваш заказ:</h1>

<div class="catalog-div">
	<?php	foreach ($cart['products'] as $id => $item): ?>
		<div>
			<a href="/catalog/card/?id=<?= $id ?>" class="single">
				<div class="img__single">
					<img src="img/<?= $item["product"]->img ?>" alt="<?= $item["product"]->title ?>">
				</div>
				<h2><?= $item["product"]->title ?></h2>
			</a>
			<h3>Цена за шт.: $<?= $item["product"]->price ?></h3>
			<p>Количество: <?= $item["count"] ?></p>
			<h3>Subtotal: $<?= $item["subtotal"]?></h3>
			<form action="/cart/delete" method="post">
				<button name="id" value="<?= $id ?>" class="delete">Удалить из корзины</button>
			</form>
		</div>
	<?php endforeach; ?>
</div>
<h3>ИТОГО: $<?= $cart['total']?></h3>
<form action="" method="post" class="cart_form">
	<input type="text" name="address" placeholder="Введите адрес доставки">
	<button formaction="/order/make" class="big__button order">Отправить</button>
</form>
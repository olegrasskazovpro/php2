<?php /** @var \app\models\Product $model */?>

<h1><?=$model->title?></h1>
<p><?=$model->desc?></p>
<h3>Цена: <?= $model->price ?> руб.</h3>
<form action="/cart/add" method="post">
	<label for="qty">Количество: </label><input type="number" name="qty" placeholder="Quantity" value="1">
	<button name="id" value="<?= $model->id?>">Add to cart</button>
</form>
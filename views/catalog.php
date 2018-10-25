<?php /** @var \app\models\Product $model */?>

<h1>Catalog</h1>

<div class="catalog-div">
	<?php foreach ($model as $val): ?>
		<div class="card">
			<a href="./?c=product&a=card&id=<?= $val->id ?>" class="single">
				<h2><?= $val->title ?></h2>
			</a>
				<p><?= $val->desc ?></p>
				<h3>Цена: <?= $val->price ?> руб.</h3>
			<form action="" method="post">
				<button name="id" value="<?= $val->id?>">Add to cart</button>
			</form>
		</div>
	<?php endforeach; ?>
</div>
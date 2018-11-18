<?php /** @var \app\controllers\UserController $user */?>
<p>Добро пожаловать, <?= $user['name'] ?>!</p>
<p>Ваш логин: <?= $user['login'] ?></p>
<a href="/user/logout"><button>Выйти</button></a>
<div>
	<h2>Ваши заказы</h2>
	<table>
		<thead>
		<tr>
			<td class="table__header">Order id</td>
			<td class="table__header">Order products</td>
			<td class="table__header">Total</td>
			<td class="table__header">Status</td>
			<td class="table__header">Cancel order</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($user['orders'] as $key => $order) :?>
			<tr>
				<td><?= $key ?></td>
				<td><?= $order['products'] ?></td>
				<td>$ <?= $order['total'] ?></td>
				<td><?= $order['status'] ?></td>
				<td>
					<form action="/order/cancel" method="post">
						<?= $order['button'] ?>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<script>
	$(function () {
		$('.cancel_order').click(function (event) {
			event.preventDefault();
			let id = $(this).val();
			$.ajax({
				method: 'POST',
				url: '/order/cancel',
				data: {
					'cancel_order_id': id
				},
				success: (response) => {
					response = JSON.parse(response);
					if(response.result === 'ok'){
						alert(response.message);
					} else {
						alert(response.message);
					}
				}
			})
		})
	})
</script>
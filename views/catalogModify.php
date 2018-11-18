<h2>Удалить товар из базы</h2>
<form action="/catalog/delete" method="post">
	<input type="number" name="id" placeholder="Введите id товара">
	<input type="submit" value="Удалить товар">
</form>
<h2>Добавить товар в базу</h2>
<form action="/catalog/add" enctype="multipart/form-data" method="post">
	<input type="text" name="title" placeholder="Заголовок товара">
	<textarea name="desc" id="" cols="30" rows="10" placeholder="Описание товара"></textarea>
	<input type="number" name="price" placeholder="Цена товара">
	<input type="file" name="img" value="Фото товара">
	<input type="submit" value="Загрузить товар">
</form>
<h1>Регистрация</h1>
<form action="/user/registration" method="post">
	<input type="text" name="name" placeholder="Ваше Имя">
	<input type="text" name="login" placeholder="Логин">
	<input type="password" name="password" placeholder="Пароль">
	<div class="error"><?= $message ?></div>
	<input type="submit" value="SIGN UP">
</form>
<br>
<p>Уже есть аккаунт? <a href="user">Войти</a></p>

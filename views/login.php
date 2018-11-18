<h1>Авторизация</h1>
<form action="/auth" method="post">
	<input type="text" name="login" placeholder="Логин">
	<input type="password" name="password" placeholder="Пароль">
	<div class="error"><?= $message ?></div>
	<input type="submit" value="SIGN IN">
</form>
<br>
<a href="/user/registration">Регистрация</a>
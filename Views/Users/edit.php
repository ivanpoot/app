<h1>Editar Usuario</h1>

<form action="users/edit" method="POST">
	<input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
	<p>First name: <input type="text" name="first_name" value="<?php echo $user["first_name"]; ?>"></p>
	<p>Last name: <input type="text" name="last_name" value="<?php echo $user["last_name"]; ?>"></p>
	<p>Email: <input type="text" name="email" value="<?php echo $user["email"]; ?>"></p>
	<p>Username: <input type="text" name="username" value="<?php echo $user["username"]; ?>"></p>
	<p>Password: <input type="password" name="password" value="<?php echo $user["password"]; ?>"></p>
	<p><input type="submit" value="Save"></p>
</form>
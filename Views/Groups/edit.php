<h2>Editar grupo</h2>

<form action="groups/edit" method="POST">
	<input type="hidden" name="id" value="<?php echo $group["id"]; ?>">
	<p>Name: <input type="text" name="name" value="<?php echo $group["name"]; ?>"></p>
	<p><input type="submit" value="Guardar"></p>
</form>
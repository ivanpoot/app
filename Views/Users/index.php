<h1>Manejo de usuarios</h1>
<a href="users/add">Agregar usuario</a>
<a href="groups">Grupos</a>
<a href="users/login">Entrar</a>

<table border="1">
	<tr>
		<th>ID</th>		
		<th>First name</th>		
		<th>Last Name</th>		
		<th>Action</th>		
	</tr>
	
	<?php
		foreach($users as $user){ ?>
		<tr>
		<td><?php echo $user['id']; ?></td>
		<td><?php echo $user['first_name']; ?></td>
		<td><?php echo $user['last_name']; ?></td>
		<td>
			<a href="users/edit/<?php echo $user['id']; ?>">Edit</a> | 
			<a href="users/delete<?php echo $user['id']; ?>">Delete</a>
		</td>
		</tr>
	<?php }	?>	
	
</table>
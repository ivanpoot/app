<h2>Groups</h2>

<a href="groups/add">Agregar grupo</a>
<table border="1">
<tr>
	<td>Id</td>
	<td>Name</td>
	<td>Action</td>
</tr>

<?php
foreach($groups as $group): ?>
<tr>
	<td><?php echo $group["id"]; ?></td>
	<td><?php echo $group["name"]; ?></td>
	<td>
		<a href="groups/edit/<?php echo $group["id"]; ?>">Edit</a> |
		<a href="groups/delete/<?php echo $group["id"]; ?>">Delete</a>
	</td>
</tr>
<?php endforeach; ?>
</table>
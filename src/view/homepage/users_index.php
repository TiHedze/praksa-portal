<?php require_once __DIR__ . "/../core/_header.php"; ?>

<table>
	<tr><th>username</th><th>name</th><th>lastname</th></tr>
	<?php
		foreach( $userList as $user )
		{
			echo '<tr>' .
			     '<td>' . $user->username . '</td>' .
			     '<td>' . $user->name . '</td>' .
                 '<td>' . $user->lastname . '</td>' .
			     '</tr>';
		}
	?>
</table>

<?php require_once __DIR__ . '/../core/_footer.php'; ?>

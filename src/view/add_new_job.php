<?php require_once __DIR__ . '/core/_header.php'; ?>

<form action="index.php?rt=company/add_new_job" method="post">
	<br>
	Studentski posao:
	<input type="text" name="jobName">
	<br>
	Opis novog posla:
	<input type="text" name="jobDescription">
	<br>
	Plaća:
	<input type="text" name="jobSalary">
	<br>
	<br>
	<button type="submit">Dodaj!</button>
</form>

<?php require_once __DIR__ . '/core/_footer.php'; ?>

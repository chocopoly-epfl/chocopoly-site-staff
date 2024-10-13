<!DOCTYPE html>
<html lang="fr">
<head><title>Create Event - Chocopoly</title></head>

<body><?php

	if($_GET['pwd'] == 'a'){

		//?pwd=a&name=amogus&dates={{'09-09-2024':'7-10.5'},{'10-10-2024':'1-10'}}&slotmax=4
		//?pwd=a&name=Abonnement Général&dates={{'21-08-2025':'10-10'},{'10-10-2024':'1-10'}}&slotmax=4
		echo $_GET['pwd'].'<br>';
		echo $_GET['name'].'<br>';
		echo $_GET['dates'].'<br>';
		echo $_GET['slotmax'].'<br>';
		require_once "autocreate.php";
		echo createEvent($_GET['name'], $_GET['dates'], $_GET['slotmax']);
	}
?></body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head><title>Create Event - Chocopoly</title></head>

<body><?php

	if($_POST['pwd'] == 'a'){

		//?pwd=a&name=Event&dates={"09-09-2024":"7-10.5","10-10-2024":"1-10"}&slotmax=4
		//?pwd=a&name=DeuxiemeEvent&dates={"21-08-2025":"10-10","10-10-2024":"1-10"}&slotmax=4
		require_once "autocreate.php";
		echo createEvent($_POST['name'], $_POST['dates'], $_POST['slotmax']);
	}
?></body>
</html>
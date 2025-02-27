<!DOCTYPE html>
<html lang="fr">
<head><title>Modifier Event - Chocopoly</title></head>

<body><?php

	parse_str(file_get_contents('php://input'), $_PATCH);
	if($_PATCH['pwd'] == 'a'){

		//?pwd=a&name=Event&dates={"09-09-2024":"7-10.5","10-10-2024":"1-10"}&slotmax=4
		//?pwd=a&name=DeuxiemeEvent&dates={"21-08-2025":"10-10","10-10-2024":"1-10"}&slotmax=4
		require_once "autocreate.php";
		if (!isset($_PATCH['name'])){$_PATCH['name'] = 'NULL';}
		if (!isset($_PATCH['date'])){$_PATCH['date'] = 'NULL';}
		if (!isset($_PATCH['slotmax'])){$_PATCH['slotmax'] = 'NULL';}
		echo modifyEvent($_PATCH['id'], $_PATCH['name'], $_PATCH['date'], $_PATCH['slotmax']);
	}
?></body>
</html>
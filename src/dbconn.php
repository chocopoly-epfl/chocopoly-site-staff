<?php
// $db_host = getenv('DB_HOST');
// $db_name = getenv('DB_NAME');
// $db_pass = getenv('DB_PASS');
// $db_user = getenv('DB_USER');
$db_host = 'localhost';
$db_name = 'chocopoly';
$db_pass = '';
$db_user = 'root';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn){
	die ("<h3 class='ktext'>Erreur de base de données</h3>
	<br><p style='font-size:25px;'>Si ce problème persiste,
	<br>veuillez contacter un admin</p>
	");
}
?>
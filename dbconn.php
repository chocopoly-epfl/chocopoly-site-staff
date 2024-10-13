<?php
$db_host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$db_pass = getenv('DB_PASS');
$db_user = getenv('DB_USER');

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn){
	die ("
	
    <head>
    <title>db error</title>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@800&display=swap' rel='stylesheet'>
    <link rel='icon' type='image/png' href='/photos/KTlogoAnimated32px.gif' sizes='32x32'>
    <link rel='stylesheet' type='text/css' href='/luxe/styles.css'>
	<link rel='stylesheet' type='text/css' href='/passwordtest/login.css'>
	<link rel='stylesheet' type='text/css' href='/js/dashboard/dashboard.css'>

    </head>

    <div class='stick'>
    <svg width='100vw' height='120' class='rect'>
    <rect rx='0' ry='0' width='100vw' height='120' style='fill:#222222'/>
    <svg x='30' dominant-baseline='middle' text-anchor='center'>
    <text x='75' y='55%' class='ktext'>KATROI</text>
	<defs>
	<clipPath id='circleView2'>
	<circle cx='30' cy='60' r='30' fill='#FFFFFF'/>
	</clipPath>
	</defs>
	<image x='0' y='25%' height='50%' xlink:href='/photos/KTlogoAnimated.gif'/>
	</svg>
	<h3 class='ktext'>Erreur de base de données</h3>
	<br><p style='font-size:25px;'>Si ce problème persiste,
	<br>veuillez envoyer un email à
	<br><a class='ktext' href='mailto:info@katroi.net'>info@katroi.net</a></p>

	");
}
?>
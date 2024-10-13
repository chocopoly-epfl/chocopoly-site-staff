<?php require "dbconn.php"; ?>

<link rel='icon' href='./photos/heart_choco.svg' sizes='32x32'>
<link href='https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@800&display=swap' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap' rel='stylesheet'>
<link rel='stylesheet' type='text/css' href='styles.css?ver=2'>

<script src='./header.js'></script>

<?php
if ($_SERVER['PHP_SELF'] != '/setname.php'){
	$_SESSION["lastpage"] = $_SERVER['PHP_SELF'];
}
if (!isset($_SESSION['Username']) && $_SERVER['PHP_SELF'] != '/setname.php'){
	die (header("Location: /setname.php", true, 301));
}else if($_SERVER['PHP_SELF'] != '/setname.php'){
	echo "<a href='./setname.php'><svg width='200' height='120' class='rect'><text x='0' y='50%' class='passinput' dominant-baseline='middle' text-anchor='center'>".$_SESSION['Username']."</text></svg></a>";
}
?>
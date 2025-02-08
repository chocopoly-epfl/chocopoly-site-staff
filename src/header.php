<?php require "dbconn.php";
session_start(); ?>

<link rel='icon' href='./photos/heart_choco.svg' sizes='32x32'>
<link href='https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@800&display=swap' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap' rel='stylesheet'>
<link rel='stylesheet' type='text/css' href='styles.css?ver=10'>

<!-- <script src='./header.js'></script> -->

<?php
echo "<span style='width:600;'><svg height='100' width='238.6' style='display: block; margin:auto; padding-top:20px; display: inline;'><a href='/'><image height='100' xlink:href='./photos/logo_vf_fond_transparent.svg'/></a></svg>";

if ($_SERVER['PHP_SELF'] != '/setname.php'){
	$_SESSION["lastpage"] = $_SERVER['PHP_SELF'];
}
if (isset($_GET['e'])){
	$_SESSION["lastpage"] .= '?e='.$_GET['e'];
}
if (!isset($_SESSION['Username']) && $_SERVER['PHP_SELF'] != '/setname.php'){
	die (header("Location: /setname.php", true, 301));
}else if($_SERVER['PHP_SELF'] != '/setname.php'){
	echo "<a href='./setname.php'><svg height='100' width='200' style='display: block; margin:auto; padding-top:20px; padding-left:100px; display: inline'><text y='50%' class='passinput' dominant-baseline='middle' text-anchor='left'>".$_SESSION['Username']."</text></a>";
}
echo "</svg></span>";
?>
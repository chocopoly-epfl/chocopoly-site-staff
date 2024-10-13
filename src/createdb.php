<?php
// function createdatabase(){

	$db_host = "localhost";
	$db_name = "chocopoly";
	$db_pass = "";
	$db_user = "root";
	
	$conn = mysqli_connect($db_host, $db_user, $db_pass);
	
	mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS chocopoly");

	mysqli_query($conn, "use chocopoly");

	mysqli_query($conn, "CREATE TABLE IF NOT EXISTS events (
		EventId int AUTO_INCREMENT,
		Name text,
		Date text NOT NULL,
		Maxslot int NOT NULL,
		Participants text DEFAULT NULL,
		Horaire text DEFAULT NULL,
		PRIMARY KEY (EventId)
	)");

	// mysqli_query($conn, "ALTER TABLE `passwords` CHANGE `user_id` `user_id` INT(11) NOT NULL AUTO_INCREMENT;");
	// mysqli_query($conn, "ALTER TABLE `passwords` CHANGE `DateCreated` `DateCreated` INT(10) NOT NULL DEFAULT CURRENT_TIMESTAMP; ");

	// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS sessions (
	// 	Username text,
	// 	SessionID text,
	// 	RandomKey text,
	// 	LastLogged int(10),
	// 	LastActive int(10)
	// )");
	// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS profile (
	// 	Username text,
	// 	Name text,
	// 	Bio text,
	// 	Notes text
	// )");
	// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS picture (
	// 	Username text,
	// 	xpos int(4),
	// 	ypos int(4),
	// 	height int(4),
	// 	picuser text,
	// 	picname text
	// )");
	// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS notes (
	// 	Username text,
	// 	nombre text,
	// 	matiere text,
	// 	note text,
	// 	coeff text,
	// 	coefftotal text
	// )");

	// mysqli_query($conn, "CREATE TABLE IF NOT EXISTS photos (
	// 	PicId int AUTO_INCREMENT,
	// 	Username text NOT NULL,
	// 	PicName text NOT NULL,
	// 	UserDate date DEFAULT NULL,
	// 	UploadDate int NOT NULL,
	// 	PRIMARY KEY (PicId)
	// )");
  
  

// }
?>
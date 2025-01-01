<?php
	// $db_host = "localhost";
	// $db_name = "chocopoly";
	// $db_pass = "";
	// $db_user = "root";
	
	$conn = mysqli_connect($db_host, $db_user, $db_pass);
	
	mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS chocopoly");

	mysqli_query($conn, "use chocopoly");

	mysqli_query($conn, "CREATE TABLE IF NOT EXISTS events (
		EventId int AUTO_INCREMENT,
		Name text,
		Date text NOT NULL,
		PseudoDate BIGINT NOT NULL,
		Maxslot int NOT NULL,
		Participants text DEFAULT NULL,
		PRIMARY KEY (EventId)
	)");
?>
<?php
require "viewevent.php";
if (isset($_POST['submit'])){
			$sql = "UPDATE events SET Participants = '".$_POST['people'].", ".$_POST['name']."' WHERE EventId = '".$_POST['ename']."';";
			$result = mysqli_query($conn, $sql);
			echo "<script type='text/JavaScript'>window.location.replace(./viewevent.php?e=".$_POST['ename'].");</script>";
	
    }
?>
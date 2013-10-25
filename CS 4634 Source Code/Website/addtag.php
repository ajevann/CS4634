<!-- This bit of code is dedicated to creating new tags to relate a 
description or entry to a tag -->

	<?php 
	header('Location: ' . "http://www.westonthayer.com/temp/edittags.php");
	
	$con = mysql_connect("localhost", "weston", "sk8ers");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("weston_designoi",$con);

	$Tag_Name=$_POST['atagname'];
	$Blurb_ID=$_POST['aid'];
	
	$query = "SELECT * FROM Tags WHERE Tag_Name='" . $Tag_Name . "'";
	$result = mysql_query($query); 
	$row = mysql_fetch_assoc($result);
	
	if ($row['_ID'] == 0)
	{
		$query = "INSERT INTO Tags VALUE('','$Tag_Name')"; 
		$resultA = mysql_query($query); 	
	}
	
	$query = "SELECT * FROM Tags WHERE Tag_Name='" . $Tag_Name . "'";
	$resultB = mysql_query($query); 
	$row = mysql_fetch_assoc($resultB);
				
	$Tag_ID = $row['_ID'];
				
	$query = "INSERT INTO BlurbTagRelationship VALUE('','$Blurb_ID','$Tag_ID')";
	$resultC = mysql_query($query);
		
	mysql_close($con);
?>
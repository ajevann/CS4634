<!-- This bit of code is used to completely remove a tag from the database. -->

<?php
	header('Location: ' . "http://www.westonthayer.com/temp/edittags.php");

	$tagid = $_GET['tagid'];

	$con = mysql_connect("localhost", "weston", "sk8ers");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("weston_designoi",$con);

	$query = "DELETE FROM Tags WHERE _ID=('$tagid')"; 
	$result=mysql_query($query); 
	
	$query = "DELETE FROM BlurbTagRelationship WHERE Tag_ID=('$tagid')";
	$result=mysql_query($query); 
?>
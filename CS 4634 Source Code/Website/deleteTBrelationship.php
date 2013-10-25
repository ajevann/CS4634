<!-- This code is used only to remove a relationship between an entry and a tag, 
but doesn't delete either of them from the database. -->

<?php
	header('Location: ' . "http://www.westonthayer.com/temp/edittags.php");

	$btid = $_GET['btid'];

	$con = mysql_connect("localhost", "weston", "sk8ers");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("weston_designoi",$con);

	$query = "DELETE FROM BlurbTagRelationship WHERE _ID=('$btid')"; 
	$result=mysql_query($query); 
?>
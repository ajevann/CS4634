<!-- This code is used to delete entries from the site and from the database. -->

<?php
	$rowid = $_GET['rowid'];
	$page = $_GET['page'];

	$con = mysql_connect("localhost", "weston", "sk8ers");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("weston_designoi",$con);

	$query = "DELETE FROM Blurb WHERE _ID=('$rowid')"; 
	$result=mysql_query($query); 

	if ($page == 1)
	{
		header('Location: ' . "http://www.westonthayer.com/temp/managecontent1.php");
	}
	elseif ($page == 2)
	{
		header('Location: ' . "http://www.westonthayer.com/temp/managecontent2.php");
	}
?>
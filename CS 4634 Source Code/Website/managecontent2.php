<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- This page is dedicated to the editing and the viewing of content 
for the dydnamic hallway display -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Zone 2</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	
	<body>
		<table width="960" height="20" bgcolor="gray">
			<tr>
				<td colspan="2" width="20">
				<td colspan="2" width="600">
					<p>VTRC-A<br>Dynamic Content Editor</p>
				</td>
				<td colspan="2" width="160">
					<a id="selectzonelink" href="selectzone.html">Select Zone</a>
					<div id="underlinemanagecontent"/>
				</td>
				<td colspan="2" width="180">
					<p>Manage Content</p>
				</td>
			</tr>
		</table>
		
		<h1>Manage Content Zone 2</h1>
		
		<table width="700" height="50" bgcolor="white" align="center">
			<tr>
				<td colspan="2" width="600"></td>
				<td colspan="2" width="100">
					<a id="addlink" href="add2.php">Add Entry</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" width="600"></td>
				<td colspan="2" width="100">
					<a id="addlink" href="edittags.php">Edit Tags</a>
				</td>
			</tr>
		</table>
		
		<?php
		$con = mysql_connect("localhost", "weston", "sk8ers");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}

		$db_selected = mysql_select_db("weston_designoi",$con);
		$sql = "SELECT * from Blurb WHERE Room='2'";
		$result = mysql_query($sql,$con);

		while ($array = mysql_fetch_array($result))
		{
			$title = $array['Primary_Title'];
			$text = $array['Primary_Text'];
			$pic = $array['Primary_Pic'];
			$people = $array['Primary_People'];
			$id = $array['_ID'];
			$page = 2;
			
			include 'contentlayout.php';
		}

		mysql_close($con);
		?>
						
	</body>
</html>


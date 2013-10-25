<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- This page provides the necessary framework to create the editing page for tags. -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Zone 1</title>
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
		
		<h1>Edit Tags</h1>
		
		<form enctype="multipart/form-data" action="addtag.php" method="POST">
			<table width="600" height="50" bgcolor="gray" align="center">
				<tr>
					<td colspan="2" width="150" align="center">
						<h3>Information Title ID: </h3>
					</td>
					<td colspan="2" width="150" align="center">
						<h3>Tag Name: </h3>
					</td>
					<td colspan="2" width="100">
					</td>
				</tr>
				<tr>
					<td colspan="2" width="150">
						<input type="text" name="aid" value=""/>
					</td>
					<td colspan="2" width="150">
						<input type="text" name="atagname" value=""/>
					</td>
					<td colspan="2" width="100">
						<input type="submit" value="Add Tag" />
					</td>
				</tr>
			</table>
		</form>
		
		<br>
		
		<?php
		$con = mysql_connect("localhost", "weston", "sk8ers");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
			
		$db_selected = mysql_select_db("weston_designoi",$con);
		$sqlTags = "SELECT * from Tags";
		$tagsArray = mysql_query($sqlTags,$con);
		
		while ($arrayTags = mysql_fetch_array($tagsArray))
		{
			$tagid = $arrayTags['_ID'];
			$tagname = $arrayTags['Tag_Name'];
			
			include 'taglist.php';
		}
		?>
	
		<br>

		<?php
		$con = mysql_connect("localhost", "weston", "sk8ers");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		
		$db_selected = mysql_select_db("weston_designoi",$con);
		$sqlBlurb = "SELECT * from Blurb";
		$resultBlurb = mysql_query($sqlBlurb,$con);
		
		while ($arrayBlurb = mysql_fetch_array($resultBlurb))
		{
			$id = $arrayBlurb['_ID'];
			$title = $arrayBlurb['Primary_Title'];
						
			$sqlBTRel = "SELECT * from BlurbTagRelationship WHERE Blurb_ID='" . $id . "'";	
			$resultBTRelTEMP = mysql_query($sqlBTRel,$con);
			$temp = mysql_fetch_array($resultBTRelTEMP);
			
			if (!$temp)
			{	
				$btid = -1;
				include 'populatetags.php';
			}
			else
			{
				$resultBTRel = mysql_query($sqlBTRel,$con);
				while ($arrayBTRel = mysql_fetch_array($resultBTRel)) 
				{
					$btid = $arrayBTRel['_ID'];
					$tagid = $arrayBTRel['Tag_ID'];
					
					$sqlTags = "SELECT * from Tags WHERE _ID='" . $tagid . "'";
					$resultTags = mysql_query($sqlTags,$con);
					
					while ($arrayTags = mysql_fetch_array($resultTags))
					{
						$tagname = $arrayTags['Tag_Name'];
						
					include 'populatetags.php';
					}
				}
			}
		}

		mysql_close($con);
		?>
						
	</body>
</html>
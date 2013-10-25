<!-- This page allows the user to be able to upload new content to the database through
the website. -->

<?php 
	$page = $_POST['room'];
	if ($page == 1)
	{
		header('Location: ' . "http://www.westonthayer.com/temp/managecontent1.php");
	}
	elseif ($page == 2)
	{
		header('Location: ' . "http://www.westonthayer.com/temp/managecontent2.php");
	}

	$target_path = "uploads/";

	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
	{
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded";
	} 
	else
	{
		echo "There was an error uploading the file, please try again!";
	}

	$con = mysql_connect("localhost", "weston", "sk8ers");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$db_selected = mysql_select_db("weston_designoi",$con);

	$Room=$_POST['room'];
	$page = $_POST['room'];
	$Primary_Pic= basename( $_FILES['uploadedfile']['name']);
	$Primary_People=$_POST['people'];
	$Primary_Title=$_POST['title'];
	$Primary_Text=$_POST['desc'];
 
	$query = "INSERT INTO Blurb VALUE('','$Room','$Primary_Pic','$Primary_People','$Primary_Title','$Primary_Text')"; 
	$result=mysql_query($query); 

	mysql_close($con);
?>
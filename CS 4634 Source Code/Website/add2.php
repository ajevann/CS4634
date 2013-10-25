<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- Page dedicated to uploading content to the hallway displays. -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Add Content</title>
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
				</td>
				<td colspan="2" width="180">
					<p>Manage Content</p>
				</td>
			</tr>
		</table>
		
		<h1>Add Content</h1>
		
		<form enctype="multipart/form-data" action="uploader.php" method="POST">
			<table width="500" height="20" bgcolor="gray" align="center">
				<tr>
					<td colspan="2" width="150">
						<h3>Picture Upload:</h3>
					</td>
					<td colspan="2" width="150">
						<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
						<input name="uploadedfile" type="file" />
					</td>
				</tr>		
				<tr>
					<td colspan="2" width="150">
						<h3>Title:</h3>
					</td>
					<td colspan="2" width="150">
						<input type="text" name="title" value=""/>
					</td>
				</tr>
				<tr>
					<td colspan="2" width="150">
					</td>
					<td colspan="2" width="150">
						<input type="submit" value="Upload Content" />
					</td>
				</tr>
			</table>
			<input type="hidden" name="room" value="2" /> 
		</form>
		
		
	</body>
</html>


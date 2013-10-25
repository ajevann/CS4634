<!-- This code is used to populate the relationships between the 
tags and description, also allowing the user to edit the tags. -->

<table width="1000" height="50" bgcolor="gray" align="center">
	<tr>
		<td colspan="2" width="100" align="center">
			<h3>ID : 
				<?php 
					if ($btid > -1)
					{
						echo $btid; 
					}
					else
					{
						echo "NONE";
					}
				?>
			</h3>
		</td>
		<td colspan="2" width="100" align="center">
			<h3>ID : <?php echo $id; ?></h3>
		</td>
		<td colspan="2" width="320">
			<h3>Title : <?php echo $title; ?></h3>
		</td>
		<td colspan="2" width="150" align="center">
			<h3>Tag ID : 
				<?php 
					if ($btid > -1)
					{
						echo $tagid; 
					}
					else
					{
						echo "NONE";
					}
				?>
			</h3>
		</td>
		<td colspan="2" width="250">
			<h3>Tag Name : 
				<?php 
					if ($btid > -1)
					{
						echo $tagname; 
					}
					else
					{
						echo "N/A";
					}
				?>
			</h3>
		</td>
		<td colspan="2" width="80">
			<a id="addlink" href="deleteTBrelationship.php?btid=<?php echo $btid ?>" >
				<?php 
					if ($btid > -1)
					{
						echo "Delete"; 
					}
					else
					{
						echo "";
					}
				?>
			</a>
		</td>
	</tr>
</table>
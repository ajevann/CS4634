<!-- This page is a bit of code that is called iteratively to repeatedly 
create the layout used for entries. -->

<table width="700" height="50" bgcolor="gray" align="center">
	<tr>
		<td colspan="2" width="200" align="center">
			<img src="uploads/<?php echo $pic; ?>" width="150" />
		</td>
		<td colspan="2" width="400">
			<h3><?php echo $title; ?></h3>
			<h3><?php echo $people; ?></h3>
			<h3><?php echo $text; ?></h3>
		</td>
		<td colspan="2" width="100">
			<a id="addlink" href="delete.php?rowid=<?php echo $id ?>&page=<?php echo $page?>" >Delete</a>
		</td>
	</tr>
	<tr>
		</p>
	</tr>
</table>

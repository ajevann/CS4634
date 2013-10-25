<!-- This code is used to populate the tag list, not the 
description-tag relationships. -->

<table width="600" height="50" bgcolor="gray" align="center">
	<tr>
		<td colspan="2" width="120" align="center">
			<h3>Tag ID: 
				<?php echo $tagid; ?>
			</h3>
		</td>
		<td colspan="2" width="400" align="center">
			<h3>Tag Name: 
				<?php echo $tagname; ?>
			</h3>
		</td>
		<td colspan="2" width="80">
			<a id="addlink" href="deletetag.php?tagid=<?php echo $tagid ?>" >Delete</a>
		</td>
	</tr>
</table>
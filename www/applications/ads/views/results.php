<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 

$caption = __(_("Manage Ads"));
$colspan = 8;

echo $search;

$colors[0] = _color1;
$colors[1] = _color2;
$colors[2] = _color3;
$colors[3] = _color4;
$colors[4] = _color5;		

$i = 0;
$j = 2;	
?>		
<table id="results" class="results">
	<caption class="caption">
		<span class="bold"><?php echo $caption; ?></span>
	</caption>
					
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>ID</th>
			<th><?php echo __(_("Title")); ?></th>
			<th><?php echo __(_("Position")); ?></th>
			<th><?php echo __(_("Banner")); ?></th>
			<th><?php echo __(_("Principal")); ?></th>
			<th><?php echo __(_("Situation")); ?></th>
			<th><?php echo __(_("Action")); ?></th>
		</tr>
	</thead>
					
	<tfoot>
		<tr>
			<td colspan="<?php echo $colspan; ?>">
				<span class="bold"><?php echo __(_("Total")); ?>:</span> <?php echo $total; ?>
			</td>
		</tr>
	</tfoot>		  
		
	<tbody>		
	<?php
		if($tFoot) {
			foreach($tFoot as $column) { 
				$ID = $column["ID_Ad"];      
				$color = ($column["Situation"] === "Deleted") ? $colors[$j] : $colors[$i];

				$i = ($i === 1) ? 0 : 1;
				$j = ($j === 3) ? 2 : 3;
				?>
				<tr style="background-color: <?php echo $color; ?>">		
					<td class="center">
						<?php echo getCheckbox($ID); ?>
					</td>
								
					<td class="center">
						<?php echo $ID; ?>
					</td>
															
					<?php			
						$title = cut($column["Title"], 4, "text");	
					?>
					
					<td>
						<?php echo $title; ?>
					</td>
								
					<td class="center">
						<?php echo __(_($column["Position"])); ?>
					</td>
								
					<?php
						if($column["Banner"] !== "") { 				
						?>
							<td class="center">
								<a href="<?php echo path($column["Banner"], TRUE); ?>" title="Banner" class="banner-lightbox">
									<?php echo __(_("Preview")); ?>
								</a>
							</td>
						<?php
						} else {
						?>				
							<td class="center">
								<?php echo __(_("Preview")); ?>
							</td>
						<?php
						}
					
						if($column["Principal"]) {
						?>			
							<td class="center">
								<?php echo __(_("Yes")); ?>
							</td>
						<?php
						} else {
						?>
							<td class="center">
								<?php echo __(_("No")); ?>
							</td>
						<?php	
						}
					?>		
						 
					<td class="center">
						<?php echo __(_($column["Situation"])); ?>
					</td>
												 
					<td class="center">
					<?php 
						if($column["Situation"] === "Deleted") {					
							echo getAction(TRUE, $ID);
						} else {					
							echo getAction(FALSE, $ID);
						}
					?>
					</td>
	 			</tr>
	 		<?php
	 		}
	 	}
	 	?>                     
	</tbody>            
</table>
		
<div class="table-options" style="position: relative; z-index: 1; margin-bottom: 25px;">
	<?php echo __(_("Select")); ?>: <br />
	
	<a onclick="checkAll('records')" class="pointer" title="<?php echo __(_("All")); ?>"><?php echo __(_("All")); ?></a> |
	<a onclick="unCheckAll('records')" class="pointer" title="<?php echo __(_("None")); ?>"><?php echo __(_("None")); ?></a><br /><br />
	
	<?php				
	if(segment(3, isLang()) === "trash") { 
	?>
		<input class="btn btn-success" onclick="javascript:return confirm(\'<?php echo __(_("Do you want to restore the records?")); ?>\')" name="restore" value="<?php echo __(_("Restore")); ?>" type="submit" class="small-input" />
		<input class="btn btn-danger" onclick="javascript:return confirm(\'<?php echo __(_("Do you want to delete the records?")); ?>\')" name="delete" value="<?php echo __(_("Delete")); ?>" type="submit" class="small-input" />
	<?php
	} else { 
	?>
		<input class="btn btn-warning" onclick="javascript:return confirm(\'<?php echo __(_("Do you want to send to trash the records?")); ?>\')" name="trash" value="<?php echo __(_("Send to trash")); ?>" type="submit" class="small-input" />
	<?php
	}
	?>					
</div>
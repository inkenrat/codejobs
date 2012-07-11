<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); 

	if(isset($data)) {
		$ID  	     = recoverPOST("ID", 	      $data[0]["ID_Video"]);
		$URL         = recoverPOST("URL",         $data[0]["URL"]);
		$ID_YouTube  = recoverPOST("ID_YouTube",  $data[0]["ID_YouTube"]);
		$title 	     = recoverPOST("title",       $data[0]["Title"]);
		$description = recoverPOST("description", $data[0]["Description"]);
		$situation 	 = recoverPOST("situation",   $data[0]["Situation"]);
		$edit        = TRUE;
		$action		 = "edit";
	} else {
		$ID          = 0;
		$URL         = recoverPOST("URL");
		$situation 	 = recoverPOST("situation");
		$edit        = FALSE;
		$action		 = "save";
	}
	
	$selected = 'selected="selected"';
?>

<div class="add-form">
	<form id="form-add" class="form-add" action="<?php echo $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><?php echo __(_("Add Video")); ?></legend>
			
			<p class="resalt">
				<?php echo __(_(ucfirst(whichApplication()))); ?>
			</p>
			
			<?php echo isset($alert) ? $alert : NULL; ?>
			
			<?php if($action == "save") { ?>
				<p class="field">
					&raquo; <?php echo __(_("URL")); ?>  <?php echo "(http://www.youtube.com/watch?v=N_1KfUDB1zU)"; ?><br />
					<input id="URL" name="URL" type="text" value="<?php echo $URL; ?>" tabindex="1" class="span10 required" />
				</p>
				
				<div id="seek">
					<p class="field">
						&raquo; <?php echo __(_("Search")); ?> (<?php echo __(_("YouTube"));?>)<br />
						<input name="search" type="text" tabindex="1" class="span10 required" />
						<input id="hsearch" name="hsearch" type="hidden" />
						
						<p>
							<input type="button" name="inputsearch" id="inputsearch" class="small-submit" value="<?php echo __(_("Search"));?>" />
						</p>
					</p>
				</div>
			
				<div id="videos">
					<?php if($videos) { ?>
						<?php foreach($videos["videos"] as $video) { ?>
							<div class="video">
							
								<p class="titleVideo">
									<input type="checkbox" name="videos[]" value="<?php echo $video["id"];?>" />
									<a href="#" title="<?php echo $video["title"];?>">
										<?php echo $video["cut"];?>
									</a>
								</p>
								
								<iframe width="195" height="200" src="http://www.youtube.com/embed/<?php echo $video["id"];?>" frameborder="0" allowfullscreen></iframe>
								
							</div>
						<?php } ?>
					<?php } else { ?>
						<p class="noresults">
							<?php echo __(_("There were no results for this search"));?>
						</p>
					<?php } ?>
				</div>
				
				<div class="clear"></div>
				
				
					<div class="controls">
						<input type="hidden" name="next" value="<?php echo $videos["next"]?>" />
						<?php if($videos["next"]) { ?>
							<input type="button" name="nextresults" id="nextresults" value="<?php echo __(_("Next results"));?>" class="small-submit"/>
						<?php } else { ?>
							<input type="button" name="nextresults" id="nextresults" value="<?php echo __(_("Next results"));?>" class="no-display small-submit"/>
						<?php } ?>
						<img class="loadgif" src="<?php echo $this->themePath; ?>/images/icons/load.gif" alt="loadgif" title="load" />
					</div>
				
				
				<div class="clear"></div>
				
			<?php } else { ?>
				<p class="field">
					&raquo; <?php echo __(_("Title")); ?> <br />
					<input id="title" name="title" type="text" value="<?php echo $title; ?>" tabindex="1" class="input required" />
				</p>
				
				<p class="field">
					&raquo; <?php echo __(_("Description")); ?> <br />
					<textarea id="description" name="description" class="input required"><?php echo $description; ?></textarea>
				</p>
				
				<input name="ID" type="hidden" value="<?php echo $ID; ?>" />
				
				<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $ID_YouTube;?>" frameborder="0" allowfullscreen></iframe>
			<?php } ?>
			
			<p class="field">
				&raquo; <?php echo __(_("State")); ?><br />
				<select id="situation" name="situation" size="1" tabindex="5" class="required">
					<option value="Active" <?php echo ($situation === "Active") ? $selected : NULL; ?>>
						<?php echo __(_("Active")); ?>
					</option>
					
					<option value="Inactive" <?php echo ($situation === "Inactive") ? $selected : NULL; ?>>
						<?php echo __(_("Inactive")); ?>
					</option>
				</select>
			</p>
			
			<p class="save-cancel">
				<input id="<?php echo $action; ?>" name="<?php echo $action; ?>" value="<?php echo __(_(ucfirst($action))); ?>" type="submit" class="btn btn-success" />
				<input id="cancel" name="cancel" value="<?php echo __(_("Cancel")); ?>" type="submit" class="btn btn-danger" tabindex="6" />
			</p>
		</fieldset>
	</form>
</div>

<?php echo $this->js("ajax/search", "videos");?>

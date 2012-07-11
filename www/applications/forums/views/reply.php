<?php if(!defined("_access")) die("Error: You don't have permission to access here...")); ?>

<?php 
	if(!isset($success)) { 
?> 
		<div class="newTopic">
			<form id="formNewTopic" action="<?php echo $href; ?>" method="post" enctype="multipart/form-data">
			<?php 
				if($action === "save") { 
			?>
					<legend><?php echo __(_("New Reply")); ?>
			<?php 
				} else { 
			?>
					<legend><?php echo __(_("Edit Reply")); ?>
			<?php 
				} 
			?>
		
			<?php echo isset($alert) ? $alert : NULL; ?>
				
			<p class="field">
				&raquo; <?php echo __(_("Title")); ?><br />
				<input class="input" id="title" name="title" type="text" value="<?php echo $title; ?>" />
			</p>
						
			<p class="field">
				&raquo; <?php echo __(_("Content")); ?><br />
				<textarea  id="editor" name="content" class="textarea"><?php echo $content; ?></textarea>
			</p>
					
			<?php 
				if(SESSION("ZanUserMethod") and SESSION("ZanUserMethod") === "twitter") { 
			?>
					<p class="checkTwitter">
						<input type="checkbox" value="Yes" name="tweet"  checked="checked"/>  <?php echo __(_("Post in Twitter")); ?>
					</p>
			<?php 
				} 
			?>	
				
			<p class="field">
				<input id="<?php echo $action; ?>" name="doAction" value="<?php echo __(_(ucfirst($action))). " ". __(_("reply")); ?>"  type="submit" class="input button" />
				<input id="cancel" name="cancel" value="<?php echo __(_("Cancel")); ?>" type="submit" class="input button" />
			</p>
				
			<input name="ID_Post" type="hidden" value="<?php echo $ID_Post; ?>" />
			<input name="ID_Forum" type="hidden" value="<?php echo $ID_Forum; ?>" />
			<input name="URL" type="hidden" value="<?php echo $hrefURL; ?>" />
				
			<?php 
				if($action === "edit") { 
			?>
					<input name="ID_Topic" type="hidden" value="<?php echo $ID_Topic; ?>" />
			<?php 
				} 
			?>
		</form>
	</div>
<?php 
	} else { 
?>
		<div class="newTopic">
		<?php 
			if($action === "save") {
				if($success > 0) { 
					echo showAlert("The reply has been saved correctly", $href);
				} elseif($success === 0) {
					echo showAlert("You need to wait 25 seconds to create a new reply", $href);
				} else { 
					echo showAlert("Ooops an unexpected problem has ocurred", "reload"));
				}
			} else { 
				if($success > 0) { 
					echo showAlert("The reply has been edited correctly", $href);
				} else { 
					echo showAlert("Ooops an unexpected problem has ocurred", "reload"));
				}
			}
		?>
		</div>
<?php 
	} 
?>
<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<form class="login" action="<?php echo path("cpanel/login"); ?>" method="post">
	<fieldset>
		<legend><?php echo __(_("Login")); ?></legend>
		
		<?php
			if(isset($error) and $error) {
				echo showError(__(_("Incorrect Login")));
			}
		?>
		
		<p class="center">
			<?php echo __(_("Authentification")); ?>
		</p>
		
		<p>
			<strong><?php echo __(_("Username")); ?>:</strong><br />
			<input id="username" class="required" name="username" type="text" tabindex="1" />
		</p>	
		
		<p>
			<strong><?php echo __(_("Password")); ?>:</strong><br />
			<input id="password" class="required" name="password" type="password" tabindex="2" />
		</p>	
		
		<p>
			<input id="connect" class="btn btn-info" name="connect" type="submit" value="<?php echo __(_("Connect")); ?>" tabindex="3" />
		</p>
		
		<input name="URL" type="hidden" value="<?php echo $URL; ?>" />
	</fieldset>
</form>

<div class="login">
	<?php $this->view("twitter", "twitter", array("redirect" => path("cpanel"))); ?>
</div>


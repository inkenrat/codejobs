<div class="form_login_twitter">
	<form class="form_login_twitter" action="<?php echo path("twitter/logout") ;?>" method="post">
		<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
		<input name="login" type="submit" value="<?php echo __(_("Logout"));?>" />
	</form>
</div>


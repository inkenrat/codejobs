<p> 
	<?php echo __(_("To recover your password, you need to access here")); ?>
</p>

<p>
	<?php echo __(_("You need access to this link:")); ?>

	<a href="<?php echo path("users/recover/$token"); ?>"><?php echo __(_("Recover Password")); ?></a>
</p>
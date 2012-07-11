<p>
	<?php echo __(_("Your account has been created")); ?>
</p>

<p>
	<?php echo __(_("You need access to this link to activate your account:")); ?><br /> 
	<a href="<?php echo path("users/activate/$user/$code"); ?>"><?php echo __(_("Activate account")); ?></a>
</p>
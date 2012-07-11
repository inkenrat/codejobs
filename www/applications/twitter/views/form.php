<div class="form_twitter">
	<form class="form_login_twitter" action="<?php echo $action;?>" method="post">
		<p class="comment-to-post">			
			<span><?php echo __(_("Your comment")); ?>: </span><br />
			<textarea class="textarea" name="comment"></textarea>
		</p>
		
		<p class="post">			
			<input type="submit" name="post-comment" value="<?php echo __(_("Comment")) ;?>" />
		</p>
	</form>
</div>

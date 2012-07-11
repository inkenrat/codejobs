<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>

<div id="home">
	<p class="resalt">
		<?php echo __("Home"); ?>
	</p>
	
	<?php
		echo $lastPosts;
		echo $lastPages;
		echo $lastLinks;
		echo $lastUsers;		
	?>	
</div>

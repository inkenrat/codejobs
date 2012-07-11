<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } 

if(is_array($post)) {				
	$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);		
	$in  = ($post["Tags"] !== "") ? __("in") : NULL;
	?>

	<div class="post">
		<div class="post-title">
			<a href="<?php echo $URL; ?>" title="<?php echo $post["Title"]; ?>">
				<?php echo $post["Title"]; ?>
			</a>
		</div>
		
		<div class="post-left">
			<?php echo __(_("Published")) ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __(_("by")) . ' <a href="'. path("users/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
		</div>
		
		<div class="post-right">
			<?php echo getTotal($post["Comments"], "comment", "comments"); ?>
		</div>
		
		<div class="clear"></div>
			
		<div class="post-content">
			<?php echo bbCode($post["Content"]); ?>
		</div>

		<div class="post-social">		
			<div class="fb-like logo-facebook" data-href="<?php echo $URL; ?>" data-send="false" data-layout="button_count" data-width="45" data-show-faces="true" data-font="arial"></div>
		
			<a href="https://twitter.com/share" data-url="<?php echo $URL;?>" data-text="<?php echo $post["Title"];?>" class="twitter-share-button logo-twitter" data-via="codejobs" data-lang="es" data-related="codejobs.biz" data-count="none" data-hashtags="codejobs.biz">
				<?php echo __(_("Tweet")); ?>
			</a>
		</div>
	</div>
	<br />
	<?php
}

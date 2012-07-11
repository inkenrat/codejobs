<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {		
	foreach($posts as $post) {			
		if(isset($post["post"])) {
			$post = array_shift($post);
		}
			
		$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);	

		$in = ($post["Tags"] !== "") ? __("in") : NULL;	

		$lock = (strlen($post["Pwd"]) === 40) ? img(get("webURL") . _sh . _lock, array("alt" => __("Private"), "class" => "no-border")) : NULL;
?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo $post["Title"]; ?>">
					<?php echo $lock . $post["Title"]; ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php 
					echo __(_("Published")) ." ". 
						 howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." ". 
					 	 __(_("by")) .' 
						 <a href="'. path("users/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
			</div>
			
			<div class="post-right">
				<?php 
					echo ($post["Enable_Comments"]) ? getTotal($post["Comments"], "comment", "comments") : NULL; 
				?>
			</div>

			<div class="clear"></div>
					
			<div class="post-content">
				<?php echo bbCode(pagebreak($post["Content"], $URL)); ?>
			</div>

			<div class="post-social">		
				<div class="fb-like logo-facebook" data-href="<?php echo $URL; ?>" data-send="false" data-layout="button_count" data-width="45" data-show-faces="true" data-font="arial"></div>
			
				<a href="https://twitter.com/share" data-url="<?php echo $URL;?>" data-text="<?php echo $post["Title"];?>" class="twitter-share-button logo-twitter" data-via="codejobs" data-lang="es" data-related="codejobs.biz" data-count="none" data-hashtags="codejobs.biz">
					<?php echo __(_("Tweet")); ?>
				</a>
			</div>
			
			<div class="clear"></div>
		</div>
				
		<div class="clear"></div>
		<?php
	}
}
	
echo isset($pagination) ? $pagination : NULL;

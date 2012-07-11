<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="editProfile">
	<?php if(_webLang === "en") { ?>
		<p class="center"><?php echo $user[0][0]["Username"] . "'s Profile";?></p>
	<?php } elseif(_webLang === "es") { ?>
		<p class="center"><?php echo "Perfil de " . $user[0][0]["Username"];?></p>
	<?php } ?>
	
	<?php echo isset($alert) ? $alert : NULL; ?>
	
	<div id="box" class="set important">
		<p class="title main"><?php echo __("Profile");?></p>
		
		<div class="avatar">
			<div id="avatar"><img src="<?php echo $avatar;?>" title="<?php echo $user[0][0]["Username"];?>" alt="<?php echo $user[0][0]["Username"];?>" /></div><br />
		</div>
		
		<div class="social">
			<?php if($twitter) { ?>
				<a class="sn" id="twitter" rel="external" href="http://twitter.com/<?php echo $user[1][0]["Twitter"];?>" title="<?php echo $user[1][0]["Twitter"];?>">	<img src="<?php echo $twitter;?>" alt="twitter.com"/>
				</a>
			<?php } ?>
			<?php if($facebook) { ?>
				<a class="sn" id="facebook" rel="external" href="http://facebook.com/<?php echo $user[1][0]["Facebook"];?>" title="<?php echo $user[1][0]["Facebook"];?>">
					<img src="<?php echo $facebook;?>" alt="facebook.com"/>
				</a>
			<?php } ?>
			<?php if($linkedin) { ?>
				<a class="sn" id="linkedin" rel="external" href="http://linkedin.com/<?php echo $user[1][0]["Linkedin"];?>" title="<?php echo $user[1][0]["Linkedin"];?>">
					<img src="<?php echo $linkedin;?>" alt="linkedin.com"/>
				</a>
			<?php } ?>
			<?php if($google) { ?>
				<a class="sn" id="google" href="http://plus.google.com/<?php echo $user[1][0]["Google"];?>/about" rel="external" title="<?php echo $user[1][0]["Google"];?>">
					<img src="<?php echo $google;?>" alt="plus.google.com"/>
				</a>
			<?php } ?>
		</div>
		
		<div class="clear"></div>
		
		<div class="wrapper">
		</div>
	</div>
</div>

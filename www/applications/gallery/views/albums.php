<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php 
	if($albums) { 
?>
		<p class="Center"><?php echo __("Albums");?></p>
	
		<ul id="Albums" class="jcarousel-skin-tango">
<?php 
		foreach($albums as $album) { 
?>
		<?php 
			$link = path("gallery/album/". $album["Album_Nice"] ."/#top"); 
		?>
			<li>
				<a href="<?php echo $link;?>" title="<?php echo $album["Title"];?>">
					<span class="albumLinks"><?php echo $album["Album"];?></span><br />
					
					<img src="<?php echo _webURL . _sh . $album["Small"];?>">
				</a>				
			</li>
<?php 
		} 
?>
		</ul>

		<br/>
		<br/>
<?php 
	}
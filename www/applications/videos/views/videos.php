<?php if(!defined("_access")) die("Error: You don't have permission to access here...");  ?>
		
<div class="videos">
	<?php
		foreach($videos as $video) {
		?>
			<p class="video-title">
				<h2>
					<a href="http://www.youtube.com/watch?v=<?php echo $video["ID_YouTube"]; ?>" target="_blank" title="<?php echo $video["Title"]; ?>">
						<?php echo $video["Title"]; ?>
					</a> 
				</h2>

				<iframe width="800" height="460" src="http://www.youtube.com/embed/<?php echo $video["ID_YouTube"]; ?>" frameborder="0" allowfullscreen></iframe>
			</p>
		<?php
		}
	?>
	
	<br /><br />

	<?php echo $pagination; ?>	
</div>
<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}
?>

<div id="comments">
<?php 
	if($dataComments) { 
		$i = 1;
	?>
		<h3 class="comment-title"><?php echo getTotal(count($dataComments), "Comment", "Comments"); ?></h3> <br />
	<?php
 		foreach($dataComments as $comment) { 
 		?>
			<div class="comment">
				<div class="comment-user">
					<span class="bold"><a href="<?php echo path("users/". $comment["Username"]); ?>"><?php echo $comment["Username"]; ?></a><br />
					<img class="avatar" src="<?php echo path("www/lib/files/images/users/". $comment["Avatar"], TRUE); ?>" alt="<?php echo $comment["Username"]; ?>" />
				</div>
															
				<div class="comment-content">
					<p class="comment-count">
						<a name="<?php echo "comment-$i"; ?>" href="<?php echo $URL ."/#comment-$i"; ?>">#<?php echo $i; ?></a>
					</p>

					<span class="small italic grey"><?php echo howLong($comment["Start_Date"]); ?></span> <br />
					<?php echo nl2br($comment["Comment"]); ?>
				</div>
				
				<div class="clear"></div>
			</div>
			<?php
			$i++;
	 	} 
 	} 
 ?>
</div>

<a name="new"></a>

<?php 
	if(SESSION("ZanUser")) {
		echo div("new-user", "class");
			echo formOpen($URL ."/#new", "form", "form");
				echo p(__(_("Post a comment!")), "resalt");

				echo ($alert) ? $alert : NULL; 			

				echo formTextarea(array(
					"id"	   => "editor",
					"name" 	   => "comment",	
					"style"    => "width: 400px",							
					"field"    => __(_("Comment")), 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("comment")
				));
						
				echo formInput(array(	
					"name" 	=> "publish",
					"type"  => "submit",
					"class" => "submit",
					"value" => __(_("Post my comment"))
				));

				echo formInput(array(	
					"name" 	=> "URL",
					"type"  => "hidden",
					"value" => $URL
				));

				echo formInput(array(	
					"name" 	=> "recordID",
					"type"  => "hidden",
					"value" => $post["ID_Post"]
				));
		
			echo formClose();
		echo div(FALSE);
	}
<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="editProfile">
	<form id="editUserProfile" action="<?php echo $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<p class="center2"><?php echo __(_("Edit Profile"); ?></p>
		
			<?php echo isset($alert) ? $alert : NULL; ?>
			
			<div id="box" class="set2 important">
				<p class="title main"><?php echo __(_("Profile")); ?></p>
				
				<div class="avatar">
					<div id="avatar">
						<img src="<?php echo $avatar;?>" title="<?php echo $user[0][0]["Username"];?>" alt="<?php echo $user[0][0]["Username"];?>" />
					</div> <br />
					
					<div class="buttons">
					<?php 
						if(SESSION("ZanUserMethod") !== "twitter") { 
					?>
							<input class="upAvatar" value="<?php echo __(_("Upload")); ?>" type="button" />
					<?php 
						} 
					?>
						<input class="editData" name="<?php echo _webLang;?>" value="<?php echo __(_("Edit Profile")); ?>" type="button" />
					</div>
				</div>

				<?php 
					if(SESSION("ZanUserMethod") !== "twitter") { 
				?>
						<input id="file" name="file" type="file" onchange="doUpload();" />
				<?php 
					} else { 
				?>
						<input id="userTwitter" name="userTwitter" value="Yes" type="hidden" />
				<?php 
					} 
				?>
				
				<div class="social">
				<?php 
					if($twitter) { 
				?>
						<a class="sn" id="twitter" rel="external" href="http://twitter.com/<?php echo $user[1][0]["Twitter"];?>" 
						title="<?php echo $user[1][0]["Twitter"];?>"><img src="<?php echo $twitter;?>" alt="twitter.com"/></a>
				<?php 
					} 
 					
 					if($facebook) { 
	 			?>
						<a class="sn" id="facebook" rel="external" href="http://facebook.com/<?php echo $user[1][0]["Facebook"];?>" 
						title="<?php echo $user[1][0]["Facebook"];?>"><img src="<?php echo $facebook;?>" alt="facebook.com"/></a>
				<?php 
					} 
					
					if($linkedin) { 
				?>
						<a class="sn" id="linkedin" rel="external" href="http://linkedin.com/<?php echo $user[1][0]["Linkedin"];?>" 
						title="<?php echo $user[1][0]["Linkedin"];?>"><img src="<?php echo $linkedin;?>" alt="linkedin.com"/></a>
				<?php 
					} 
					
					if($google) { 
				?>
						<a class="sn" id="google" href="http://plus.google.com/<?php echo $user[1][0]["Google"];?>/about" rel="external" 
						title="<?php echo $user[1][0]["Google"];?>"><img src="<?php echo $google;?>" alt="plus.google.com"/></a>
				<?php 
					} 
				?>
				</div>
				
				<div class="clear"></div>
				
				<div class="wrapper">
					<div class="blocktitle maintop"><?php echo __(_("Main Information")); ?></div>

					<div class="information principal">
						<div id="mainhide">
							<p>
								<strong><?php echo __(_("User")); ?>:</strong> <?php echo $user[0][0]["Username"];?>
							</p>
							
							<p>
								<strong <?php echo ((!$user[0][0]["Email"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Email")); ?>:
								</strong> 
								<?php echo $user[0][0]["Email"];?>
							</p>
							
							<p>
								<strong><?php echo __(_("Rank")); ?>:</strong> <?php echo __(_($user[0][0]["Rank"]);?>
							</p>
							
							<p>
								<strong><?php echo __(_("Join Date")); ?>:</strong> <?php echo $joinDate;?>
							</p>
							
							<p class="website">
								<strong <?php echo ((!$user[0][0]["Website"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Website")); ?>:
								</strong> 

								<a <?php echo ((!$user[0][0]["Website"]) ? 'style="display:none;" class="remove"' : null);?> 
								href="<?php echo $user[0][0]["Website"];?>" id="website">
									<?php echo __(_("Go")); ?>
								</a>
							</p>
						</div>
					</div>
					
					<div class="blocktitle private"><?php echo __(_("Personal Information")); ?></div>
					
					<div class="information personal">
						<div id="personalhide">
							<p class="name">
								<strong <?php echo ((!$user[1][0]["Name"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Name")); ?>:
								</strong> 

								<span id="name"><?php echo $user[1][0]["Name"];?></span>
							</p>
							
							<p class="gender">
								<strong <?php echo ((!$user[1][0]["Gender"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Gender")); ?>:
								</strong> 

								<span id="gender"><?php echo __(_($user[1][0]["Gender"]);?></span>
							</p>
							
							<p class="birthday">
								<strong <?php echo ((!$user[1][0]["Birthday"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Birthday")); ?>:
								</strong> 

								<span id="birthday"><?php echo $user[1][0]["Birthday"];?></span>
							</p>
							
							<p class="company">
								<strong <?php echo ((!$user[1][0]["Company"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Company")); ?>:
								</strong> 

								<span id="company"><?php echo $user[1][0]["Company"];?></span>
							</p>
								
							<p class="telephone">
								<strong <?php echo ((!$user[1][0]["Phone"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Telephone")); ?>:
								</strong> 
								
								<span id="telephone"><?php echo $user[1][0]["Phone"];?></span>
							</p>
						</div>
					</div>
					
					<div class="blocktitle stats"><?php echo __(_("User Statistics")); ?></div>
					
					<div class="information statistics">
						<div id="statshide">
							<p><strong><?php echo __(_("Messages")); ?>:</strong> <?php echo $user[0][0]["Messages"];?></p>
							<p><strong><?php echo __(_("Receive Messages")); ?>:</strong> <?php echo __(_($user[0][0]["Recieve_Messages"]);?></p>
							<p><strong><?php echo __(_("Comments")); ?>:</strong> <?php echo $user[0][0]["Comments"];?></p>
							<p><strong><?php echo __(_("Subscribed")); ?>:</strong> <?php echo $user[0][0]["Subscribed"];?></p>
						</div>
					</div>
					
					<?php 
						if($user[1][0]["Country"] === "" and $user[1][0]["District"] === "" and $user[1][0]["Town"] === "") {
							$showLocation = FALSE;
						} else {
							$showLocation = TRUE;
						}
					?>
					
					<div id="location" <?php echo ((!$showLocation) ? 'style="display:none;"' : null);?> class="blocktitle location">
						<?php echo __(_("User Location")); ?>
					</div>
					
					<div class="information ubication">
						<div id="ubihide">
							<p class="country">
								<strong <?php echo ((!$user[1][0]["Country"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Country")); ?>:
								</strong> 

								<span id="country"><?php echo $user[1][0]["Country"];?></span></p>
								
							<p class="district">
								<strong <?php echo ((!$user[1][0]["District"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("District")); ?>:
								</strong> 

								<span id="district"><?php echo $user[1][0]["District"];?></span>
							</p>
							
							<p class="town">
								<strong <?php echo ((!$user[1][0]["Town"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Town")); ?>:
								</strong> 

								<span id="town"><?php echo $user[1][0]["Town"];?></span>
							</p>
						</div>					
					</div>
					
					<?php 
						if($user[0][0]["Sign"] === "") {
							$showOther = FALSE;
						} else {
							$showOther = TRUE;
						}
					?>

					<div id="other" <?php echo ((!$showOther) ? 'style="display:none;"' : null);?> 
					class="blocktitle other"><?php echo __(_("Social Information")); ?></div>
					
					<div class="information socialmedia">
						<div id="socialhide">
							<p class="sign">
								<strong <?php echo ((!$user[0][0]["Sign"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __(_("Sign")); ?>:
								</strong>
							</p>
							
							<div id="sign"><?php echo $user[0][0]["Sign"];?></div>
							
							<div id="sclntw">
								<p class="twitter"><strong>Twitter:</strong></p>
								<p class="facebook"><strong>Facebook:</strong></p>
								<p class="linkedin"><strong>LinkedIn:</strong></p>
								<p class="google"><strong>Google:</strong></p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
						
			<input class="removable" name="website" type="hidden" value="<?php echo $user[0][0]["Website"];?>" />
			<input class="removable" name="twitter" type="hidden" value="<?php echo $user[1][0]["Twitter"];?>" />
			<input class="removable" name="facebook" type="hidden" value="<?php echo $user[1][0]["Facebook"];?>" />
			<input class="removable" name="linkedin" type="hidden" value="<?php echo $user[1][0]["Linkedin"];?>" />
			<input class="removable" name="google" type="hidden" value="<?php echo $user[1][0]["Google"];?>" />
			<input class="removable" name="name" type="hidden" value="<?php echo $user[1][0]["Name"];?>" />
			<input class="removable" name="gender" type="hidden" value="<?php echo $user[1][0]["Gender"];?>" />
			<input class="removable" name="birthday" type="hidden" value="<?php echo $user[1][0]["Birthday"];?>" />
			<input class="removable" name="company" type="hidden" value="<?php echo $user[1][0]["Company"];?>" />
			<input class="removable" name="country" type="hidden" value="<?php echo $user[1][0]["Country"];?>" />
			<input class="removable" name="district" type="hidden" value="<?php echo $user[1][0]["District"];?>" />
			<input class="removable" name="town" type="hidden" value="<?php echo $user[1][0]["Town"];?>" />
			<input class="removable" name="telephone" type="hidden" value="<?php echo $user[1][0]["Phone"];?>" />
			<input class="removable" name="sign" type="hidden" value="<?php echo $user[0][0]["Sign"];?>" />
			<input name="ID_User" type="hidden" value="<?php echo $ID;?>" />
		</fieldset>
	</form>
</div>
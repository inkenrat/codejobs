<?php if(!defined("_access")) die("Error: You don't have permission to access here...")); ?>

<?php 
	if(!SESSION("ZanUserID")) { 
?>
		<div class="twitterButton">
			<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
		</div>
		
		<div class="clear"></div>
<?php 
	} 
?>

<div class="actions">
<?php 
	if(SESSION("ZanUserID") > 0) { 
?>
		<p class="welcome">
			<?php echo __(_("Welcome to the forums of")); ?> <?php echo _webName; ?>, 
			<a href="<?php echo path("users/editprofile")); ?>" title="<?php echo SESSION("ZanUser")); ?>"><?php echo SESSION("ZanUser")); ?></a>!</p>
			
			<div class="options">
				<ul>
					<li class="main"><?php echo __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li>
						<a href="<?php echo path("users/editprofile")); ?>" title="<?php echo __(_("Edit Profile")); ?>">
							<?php echo __(_("Edit Profile")); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo path("users/logout/forums")); ?>" title="<?php echo __(_("Logout")); ?>"><?php echo __(_("Logout")); ?></a>
					</li>
				</ul>
			</div>
<?php 
	} else { 
?>
		<p class="welcome">
			<?php echo __(_("Welcome to the forums of")); ?> <?php echo _webName; ?>, 
			<?php echo __(_("please login to enjoy the forums or register if you don't have an account")); ?>.
		</p>
		
		<div class="options">
			<ul>
				<li class="main"><?php echo __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
				<li><a class="signIn" href="<?php echo path("users/login/forums"; ?>" title="<?php echo __(_("Login")); ?>"><?php echo __(_("Login")); ?></a></li>
				<li><a class="signUp" href="<?php echo path("users/register/forums"; ?>" title="<?php echo __(_("Sign up")); ?>"><?php echo __(_("Sign up")); ?></a></li>
			</ul>
		</div>
<?php 
	} 
?>
</div>

<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php echo __(_("Forums")); ?></span>
		</caption>
		
		<thead>
			<tr>
				<th class="first"><?php echo __(_("Forum")); ?></th>
				<th class="second"><?php echo __(_("Last Message")); ?></th>
				<th class="third"><?php echo __(_("Topics")); ?></th>
				<th class="fourth"><?php echo __(_("Messages")); ?></th>
				<?php 
					if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { 
				?>
						<th class="fifth"><?php echo __(_("Actions")); ?></th>
				<?php 
					} 
				?>
			</tr>
		</thead>

		<tbody>
		<?php 
			$j = 0; 

			foreach($forums as $forum) { 
		?>
				<tr class="rows <?php echo ($j % 2 === 0) ? "odd" : "even"; ?>">
					<td class="first">
						<span class="forumTitle2">
							<a title="<?php echo $forum["Title"]; ?>" href="<?php echo path("forums/". $forum["Nice"]; ?>"><?php echo $forum["Title"]; ?></a>
						</span>
						<br />
						<div class="forumDesc"><?php echo $forum["Description"]; ?></div>
					</td>

					<td class="second">
					<?php 
						if(is_null($forum["Last_Date"])) { 
					?>
							<span class="postDate"><?php echo $forum["Last_Reply"]; ?></span>
					<?php 
						} else { 
					?>
							<span class="forumTitle">
								<a title="<?php echo $forum["Last_Reply_Title"]; ?>" href="<?php echo $forum["Last_URL"]; ?>">
									<?php echo $forum["Last_Reply_Title"]; ?>
								</a>
							</span>

							<span class="postAuthor"> 
								<?php echo __(_("written by")); ?> 
								
								<a title="<?php echo $forum["Last_Reply_Author"]?>" href="<?php echo path("users/profile/". $forum["Last_Reply_Author_ID"]; ?>">
									<?php echo $forum["Last_Reply_Author"]?>
								</a>.
							</span>
							
							<br />
							
							<span class="postDate"><?php echo howLong($forum["Last_Date2"]); ?></span>
					<?php 
						}
					?>
					</td>
					
					<td class="third"><span class="forumNumbers"><?php echo $forum["Topics"]; ?></span></td>
					<td class="fourth"><span class="forumNumbers"><?php echo $forum["Replies"]; ?></span></td>
					<?php 
						if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { 
					?>
							<td class="fifth">
								<div class="actionbutton">
									<a title="<?php echo __(_("Edit")); ?>" onclick="return confirm('<?php echo __(_("Do you want to edit the forum?")); ?>');" 
									href="<?php echo $forum["editURL"]; ?>" class="ui-icon ui-icon-pencil">
										<span class="hide">Edit</span>
									</a>
								</div>
								
								<div class="actionbutton">
									<a title="<?php echo __(_("Delete")); ?>" onclick="return confirm('<?php echo __(_("Do you want to delete the forum?")); ?>');" 
									href="<?php echo $forum["deleteURL"]; ?>" class="ui-icon ui-icon-trash"></a>
									<span class="hide">Delete</span>
								</div>
							</td>
					<?php 
						} 
					?>
				</tr>
		<?php 
				$j++; 
			} 
		?>
		</tbody>		
	</table>
</div>	

<div class="forumsFooter">
	<div class="privileges">
		<p class="footerTitle"><?php echo __(_("Extra information")); ?>.</p>
		
		<img src="<?php echo $avatar; ?>" title="<?php echo ((SESSION("ZanUser")) ? SESSION("ZanUser") : __(_("Sign up, please") . " :)")); ?>" 
			alt="<?php echo __(_("A user avatar")); ?>" />
		
		<?php 
			if(SESSION("ZanUserID")) { 
				if(SESSION("ZanUserPrivilege") === "Super Admin") { 
		?>
					<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
						<?php echo __(_("Hi there!, ")); ?> <a href="<?php echo path("users/editprofile")); ?>" title="<?php echo SESSION("ZanUser")); ?>">
						<?php echo SESSION("ZanUser")); ?></a>. 
						<br /> 
						<?php echo __(_("Here are your statistics")); ?>: <br />
						
						<ul class="userStatistics">
							<li><strong><?php echo __(_("Topics")); ?>:</strong>  <?php echo $stats[0]["Topics"];  ?></li>
							<li><strong><?php echo __(_("Replies")); ?>:</strong> <?php echo $stats[0]["Replies"]; ?></li>
							<li><strong><?php echo __(_("Visits")); ?>:</strong>  <?php echo $stats[0]["Visits"];  ?></li>
						</ul>
					</p>
				
					<ul class="lsprivileges2">
						<li>
							<?php echo __(_("You can")); ?> 
							<a href="<?php echo path("forums/cpanel/add")); ?>" title="<?php echo __(_("Create Forums")); ?>">
								<?php echo __(_("create")); ?>
							</a> 
							<?php echo __(_("new forums")); ?>.
						</li>
						<li><?php echo __(_("You can create new topics")); ?>.</li>
						<li><?php echo __(_("You can reply to topics")); ?>.</li>
						<li><?php echo __(_("You can send private messages")); ?>.</li>
					</ul>
		<?php 
				} elseif(SESSION("ZanUserPrivilege") === "Member") { 
		?>
					<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2"; : "onlineUserInfo"; ?>">
						<?php echo __(_("Hi there!, ")); ?> 
						<a href="<?php echo path("users/editprofile")); ?>" title="<?php echo SESSION("ZanUser")); ?>">
							<?php echo SESSION("ZanUser")); ?>
						</a>. 
						<br /> 

						<?php echo __(_("Here are your statistics")); ?>: <br />
						
						<ul class="userStatistics">
							<li><strong><?php echo __(_("Topics")); ?>:</strong> <?php echo $stats[0]["Topics"]; ?></li>
							<li><strong><?php echo __(_("Replies")); ?>:</strong> <?php echo $stats[0]["Replies"]; ?></li>
							<li><strong><?php echo __(_("Visits")); ?>:</strong> <?php echo $stats[0]["Visits"]; ?></li>
						</ul>
					</p>
					
					<ul class="lsprivileges2">
						<li class="noprivilege"><?php echo __(_("You can <strong>NOT</strong> create new forums")); ?>.</li>
						<li><?php echo __(_("You can create new topics")); ?>.</li>
						<li><?php echo __(_("You can reply to topics")); ?>.</li>
						<li><?php echo __(_("You can send private messages")); ?>.</li>
					</ul>
		<?php 
				} 
		 	} else { 
		?> 
				<p class="noUserInfo">
					<?php echo __(_("Hi there!, you should")); ?> 
					<a class="signIn" href="<?php echo path("users/login/forums"; ?>" title="<?php echo __(_("Login")); ?>">
						<?php echo __(_("login")); ?>
					</a> 

					<?php echo __(_("to enjoy full access to the forums")); ?>.
					<br />
					<?php echo __(_("If you don't have an account, you can create it")); ?> 
					<a class="signUp" href="<?php echo path("users/register/forums"; ?>" title="<?php echo __(_("Sign up")); ?>"><?php echo __(_("here")); ?></a>.
				</p>
				
				<ul class="lsprivileges">
					<li class="noprivilege"><?php echo __(_("You can <strong>NOT</strong> create new forums")); ?>.</li>
					<li class="noprivilege"><?php echo __(_("You can <strong>NOT</strong> create new topics")); ?>.</li>
					<li class="noprivilege"><?php echo __(_("You can <strong>NOT</strong> reply to topics")); ?>.</li>
					<li class="noprivilege"><?php echo __(_("You can <strong>NOT</strong> send private messages")); ?>.</li>
				</ul>
		<?php 
			} 
		?>
	</div>
	
	<div class="lastUsers">
		<p class="footerTitle"><?php echo __(_("Last registered users")); ?>.</p>

		<ol>
		<?php 
			foreach($users as $user) { 
		?>
				<li>
					<a href="<?php echo path("users/profile/". $user["ID_User"]); ?>" title="<?php echo $user["Username"]; ?>">
						<?php echo $user["Username"]; ?>
					</a>
				</li>
		<?php 
			} 
		?>
		</ol>
	</div>
	
	<div class="clear"></div>
</div>
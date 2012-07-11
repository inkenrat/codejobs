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
			<?php echo __(_("Welcome to this topic")); ?>, 
			
			<a href="<?php echo path("users/editprofile")); ?>" title="<?php echo SESSION("ZanUser")); ?>"><?php echo SESSION("ZanUser")); ?></a>. 
			
			<?php echo __(_("Feel free of reply to the topic")); ?>.</p>
			
			<div class="options">
				<ul>
					<li class="main"><?php echo __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li>
						<a href="<?php echo path("forums/". segment(2) ."/". segment(3) ."/new")); ?>" title="<?php echo __(_("Reply the topic")); ?>!">
							<?php echo __(_("Reply")); ?>!
						</a>
					</li>
					<li><a href="<?php echo path("forums/". segment(2)) ; ?>" title="<?php echo __(_("Back to the forum")); ?>!"><?php echo __(_("Back")); ?></a></li>
					<li><a href="<?php echo path("forums")); ?>" title="<?php echo __(_("Forums")); ?>!"><?php echo __(_("Forums")); ?></a></li>
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
			<?php echo __(_("please login to enjoy the forums or register if you don't have an account")); ?>.</p>
			
			<div class="options">
				<ul>
					<li class="main"><?php echo __(_("Options")); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li><a href="<?php echo path("forums/". segment(2)); ?>" title="<?php echo __(_("Back to the forum")); ?>!"><?php echo __(_("Back")); ?></a></li>
					<li><a href="<?php echo path("forums")); ?>" title="<?php echo __(_("Forums")); ?>!"><?php echo __(_("Forums")); ?></a></li>
					<li>
						<a class="signIn" href="<?php echo path("users/login/forums"; ?>" title="<?php echo __(_("Login")); ?>"><?php echo __(_("Login")); ?></a>
					</li>
					<li>
						<a class="signUp" href="<?php echo path("users/register/forums"; ?>" title="<?php echo __(_("Sign up")); ?>">
							<?php echo __(_("Sign up")); ?>
						</a>
					</li>
				</ul>
			</div>
<?php 
	} 
?>
</div>

<div id="wrapper">
	<div class="pagination">
	<?php 
		if(isset($pagination)) {
			echo $pagination;
		} 
	?>
	</div>
	
	<div class="clear"></div>
	
	<table id="topic">
		<tbody>
			<tr>
				<td class="caption">
					<p class="titleTopic"><?php echo $data["topic"][0]["Title"]; ?></p>
				</td>
			</tr>

			<tr>
				<td class="profile">
<?php 
				if($data["topic"][0]["Avatar"] !== "") { 
					if($data["topic"][0]["Type"] === "Normal") { 
?>
						<img src="<?php echo _webURL . _sh . $data["topic"][0]["Avatar"]; ?>" title="<?php echo $data["topic"][0]["Username"]; ?>" /><br />
<?php 
					} elseif($data["topic"][0]["Type"] === "Twitter") { 
?>
						<img src="<?php echo $data["topic"][0]["Avatar"]; ?>" title="<?php echo $data["topic"][0]["Username"]; ?>" /><br />
<?php 
					} 
				} else { 
?>
					<img src="<?php echo _webURL . "www/lib/files/images/users/default.png"; ?>" title="<?php echo $data["topic"][0]["Username"]; ?>" /><br />
<?php 
				} 
?>				
					<div class="userinfo">
						<p>
							<strong>
								<a href="<?php echo path("users/profile/". $data["topic"][0]["ID_User"]); ?>" title="<?php echo $data["topic"][0]["Username"]; ?>">
									<?php echo $data["topic"][0]["Username"]; ?>
								</a>
							</strong>
						</p>
						
						<p><?php echo __(_($data["topic"][0]["Rank"]); ?></p>
<?php 
						if($data["topic"][0]["Country"]) { 
?>
							<p><?php echo $data["topic"][0]["Country"]; ?></p>
<? 	
						} 
					
						if($data["topic"][0]["Website"]) { 
?>
							<a href="<?php echo $data["topic"][0]["Website"]; ?>" rel="external" title="<?php echo $data["topic"][0]["Website"]; ?>">
								<?php echo __(_("Website")); ?>
							</a>
<?php 
						} 
?>
					</div>
					
					<div class="topicInfo2">
						<p><?php echo $data["topic"][0]["Text_Date"]; ?></p>
						<p><?php echo $data["topic"][0]["Hour"]; ?></p>
					</div>	
					
					<div class="clear"></div>
				</td>
			</tr>

<?php 
		if(SESSION("ZanUserID")) { 
?>
			<tr class="actionsTopic">
				<td>
					<ul>
<?php 
					if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $data["topic"][0]["ID_User"])) { 
?>
						<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __(_("Reply")); ?>"><?php echo __(_("Reply")); ?></a></li>
						<li>
							<a title="<?php echo __(_("Edit")); ?>" onclick="return confirm('<?php echo __(_("Do you want to edit the topic?")); ?>');" 
							href="<?php echo $data["topic"][0]["editURL"]; ?>">
								<?php echo __(_("Edit")); ?>
							</a>
						</li>
						<li>
							<a title="<?php echo __(_("Delete")); ?>" onclick="return confirm('<?php echo __(_("Do you want to delete the topic?")); ?>');" 
							href="<?php echo $data["topic"][0]["deleteURL"]; ?>">
								<?php echo __(_("Delete")); ?>
							</a>
						</li>
<?php 
					} elseif(SESSION("ZanUserID")) { 
?>
						<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __(_("Reply")); ?>"><?php echo __(_("Reply")); ?></a></li>
<?php 
					} 
?>
					</ul>
				</td>
			</tr>
<?php 
		} 
?>
			<tr>
				<td class="topicContent">
					<div class="topicData">
						<p><?php echo $data["topic"][0]["Content"]; ?></p>
						
<?php 
						if($data["topic"][0]["Sign"] !== "") { 
?>
							<p class="sign"><?php echo $data["topic"][0]["Sign"]; ?></p>
<?php 
						} 
?>
					</div>
				</td>
			</tr>

<?php 	
	$i = 0;
			
	if(is_array($data["replies"])) { 
		foreach($data["replies"] as $reply) {
?>
			<tr class="space">
				<?php $i++; ?>
			</tr>
					
			<tr>
<?php 
				if($i === $count) { 
?>
					<a name="bottom"></a>
<?php 
				} 
?>
				<a name="<?php echo $reply["ID_Post"]; ?>"></a>
								
				<td class="profile">
<?php 
				if($reply["Avatar"] !== "") { 
					if($reply["Type"] === "Normal") { 
?>
						<img src="<?php echo _webURL . _sh . $reply["Avatar"]; ?>" title="<?php echo $reply["Username"]; ?>" /><br />
<?php 
					} elseif($reply["Type"] === "Twitter") { 
?>
						<img src="<?php echo $reply["Avatar"]; ?>" title="<?php echo $reply["Username"]; ?>" /><br />
<?php 
					} 			
				} else { 
?>
					<img src="<?php echo _webURL ."/www/lib/files/images/users/default.png"; ?>" title="<?php echo $reply["Username"]; ?>" /><br />
<?php 
				} 
?>
					<div class="userinfo">
						<p>
							<strong>
								<a href="<?php echo path("users/profile/". $reply["ID_User"]); ?>" title="<?php echo $reply["Username"]; ?>">
									<?php echo $reply["Username"]; ?>
								</a>
							</strong>
						</p>
						
						<p><?php echo __(_($reply["Rank"]); ?></p>
<?php 
							if($reply["Country"]) { 
?>
								<p><?php echo $reply["Country"]; ?></p>
<?php 
							} 
 						
 							if($reply["Website"]) { 
?>
								<a href="<?php echo $reply["Website"]; ?>" rel="external" title="<?php echo $reply["Website"]; ?>"><?php echo __(_("Website")); ?></a>
<?php 
							} 
?>
					</div>
									
					<div class="topicInfo2">
						<p><strong><?php echo $reply["Title"]; ?></strong></p>
						<p><?php echo $reply["Text_Date"]; ?></p>
						<p><?php echo $reply["Hour"]; ?></p>			
					</div>	
				</td>
			</tr>
<?php 
			if(SESSION("ZanUserID")) { 
?>
				<tr class="actionsTopic">
					<td>
						<ul>
<?php 
							if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $reply["ID_User"])) { 
?>
								<li>
									<a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __(_("Reply")); ?>"><?php echo __(_("Reply")); ?></a>
								</li>
								<li>
									<a title="<?php echo __(_("Edit")); ?>" onclick="return confirm('<?php echo __(_("Do you want to edit the reply?")); ?>');" href="<?php echo $reply["editURL"]; ?>"><?php echo __(_("Edit")); ?></a>
								</li>
								<li>
									<a title="<?php echo __(_("Delete")); ?>" onclick="return confirm('<?php echo __(_("Do you want to delete the reply?")); ?>');" href="<?php echo $reply["deleteURL"]; ?>"><?php echo __(_("Delete")); ?></a>
								</li>
<?php 
							} elseif(SESSION("ZanUserID")) { 
?>
								<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __(_("Reply")); ?>"><?php echo __(_("Reply")); ?></a></li>
<?php 
							} 
?>
						</ul>
					</td>
				</tr>
<?php 
			} 
?>
				<tr>
					<td class="topicContent">
						<div class="topicData">
							<p><?php echo $reply["Content"]; ?></p>
<?php 						
							if($data["topic"][0]["Sign"] !== "") { 
?>
								<p class="sign"><?php echo $reply["Sign"]; ?></p>
<?php 
							} 
?>										
						</div>
					</td>
				</tr>
<?php
		} 
	} 
?>
		</tbody>
	</table>
</div>

<div class="pagination2">
<?php 
	if(isset($pagination)) {
		echo $pagination;
	} 
?>
</div>

<div class="clear"></div>

<div class="forumsFooter">
	<div class="privileges">
		<p class="footerTitle"><?php echo __(_("Extra information")); ?>.</p>
		
		<img src="<?php echo $avatar; ?>" title="<?php echo ((SESSION("ZanUser")) ? SESSION("ZanUser") : __(_("Sign up, please") ." :)")); ?>" alt="<?php echo __(_("A user avatar")); ?>" />

<?php 
		if(SESSION("ZanUserID")) { 
			if(SESSION("ZanUserPrivilege") === "Super Admin") { 
?>
				<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
					<?php echo __(_("Hi there!, ")); ?> 
					<a href="<?php echo path("users/editprofile")); ?>" title="<?php echo SESSION("ZanUser")); ?>"><?php echo SESSION("ZanUser")); ?></a>. <br /> 
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
						<a href="<?php echo path("forums/cpanel/add"); ?>" title="<?php echo __(_("Create Forums")); ?>"><?php echo __(_("create")); ?></a> 
						<?php echo __(_("new forums")); ?>.
					</li>
					<li><?php echo __(_("You can create new topics")); ?>.</li>
					<li><?php echo __(_("You can reply to topics")); ?>.</li>
					<li><?php echo __(_("You can send private messages")); ?>.</li>
				</ul>
<?php 
			} elseif(SESSION("ZanUserPrivilege") === "Member") { 
?>
				<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
					<?php echo __(_("Hi there!, ")); ?> 
					<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser")); ?>">
						<?php echo SESSION("ZanUser")); ?>
					</a>. <br /> 
					
					<?php echo __(_("Here are your statistics")); ?>: <br />
					
					<ul class="userStatistics">
						<li><strong><?php echo __(_("Topics")); ?>:</strong>  <?php echo $stats[0]["Topics"];  ?></li>
						<li><strong><?php echo __(_("Replies")); ?>:</strong> <?php echo $stats[0]["Replies"]; ?></li>
						<li><strong><?php echo __(_("Visits")); ?>:</strong>  <?php echo $stats[0]["Visits"];  ?></li>
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
				<a class="signIn" href="<?php echo path("users/login/forums"); ?>" title="<?php echo __(_("Login")); ?>">
					<?php echo __(_("login")); ?>
				</a> 

				<?php echo __(_("to enjoy full access to the forums")); ?>. <br />
				<?php echo __(_("If you don't have an account, you can create it")); ?> 
				<a class="signUp" href="<?php echo path("users/register/forums"); ?>" title="<?php echo __(_("Sign up")); ?>"><?php echo __(_("here")); ?></a>.
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
				<a href="<?php echo path("users/profile/". $user["ID_User"]); ?>" title="<?php echo $user["Username"]; ?>"><?php echo $user["Username"]; ?></a>
			</li>
<?php 
		} 
?>
		</ol>
	</div>
	
	<div class="clear"></div>
</div>
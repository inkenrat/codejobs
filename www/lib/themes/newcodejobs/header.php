<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php echo $this->getTitle(); ?></title>
	
	<link rel="stylesheet" href="<?php echo path("www/lib/css/default.css", TRUE); ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/mediaqueries.css" type="text/css">
	
	
	<?php 
		echo $this->getCSS(); 
	 	
	 	echo $this->js("jquery", NULL, TRUE); 
	 ?>

	<script type="text/javascript" src="<?php echo $this->themePath; ?>/js/social.js"></script>

	<script type="text/javascript" src="<?php echo $this->themePath; ?>/js/porlets.js"></script>
</head>

<body>	
	<header>
		<div id="fb-root"></div> 
		<div id="topbar-wrapper">
			<div id="topbar">
				<nav>
					<ul>
						<li><a href="<?php echo path(); ?>"><?php echo __("Home"); ?></a></li>
						<?php if(get("ready")) { ?><li><a href="<?php echo path("codes"); ?>"><?php echo __(_("Codes")); ?></a></li><?php } ?>
						<?php if(get("ready")) { ?><li><a href="<?php echo path("jobs"); ?>"><?php echo __(_("Jobs")); ?></a></li><?php } ?>
						<?php if(get("ready")) { ?><li><a href="<?php echo path("forums"); ?>"><?php echo __(_("Forums")); ?></a></li><?php } ?>
						<li><a href="<?php echo path("videos"); ?>"><?php echo __(_("Videos")); ?></a></li>
						<li><a href="<?php echo path("bookmarks"); ?>"><?php echo __(_("Bookmarks")); ?></a></li>
					</ul>
				</nav>

				<div id="top-box-languages" class="toggle">
					<a href="<?php echo path("es"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/es.png" alt="Español" /></a>
					<a href="<?php echo path("en"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/en.png" alt="Español" /></a>
					<a href="<?php echo path("fr"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/fr.png" alt="Español" /></a>
					<a href="<?php echo path("pt"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/pt.png" alt="Español" /></a>
				</div>

				<div id="top-box-register" class="toggle">
					<span class="bold"><?php echo __("Are you new on CodeJobs?, Register!"); ?></span><br />

					<form action="<?php echo path("users/register"); ?>" method="post" class="form-register">
						<fieldset>
							<input id="register-name" name="name" class="register-input" type="text" required placeholder="<?php echo __(_("Full Name")); ?>" /> <br />
							<input id="register-email" name="email" class="register-input" type="email" required placeholder="Email" /> <br />
							<input id="register-password" name="password" class="register-input" type="password" required placeholder="<?php echo __(_("Password")); ?>" /> <br />
							<input name="register" class="register-submit" type="submit" value="<?php echo __(_("Register on CodeJobs!")); ?>" />
						</fieldset>
					</form>
				</div>

				<div id="top-box-login" class="toggle">
					<span class="bold"><?php echo __(_("Do you Have an account?, Login!")); ?></span><br />

					<form action="<?php echo path("users/login"); ?>" method="post" class="form-login">
						<fieldset>
							<input id="login-username" name="username" class="login-input" type="text" required placeholder="<?php echo __(_("Username or Email")); ?>" /> <br />
							<input id="login-password" name="password" class="login-input" type="password" required placeholder="<?php echo __(_("Password")); ?>" /> 
							<br />
							<a href="<?php echo path("users/recover"); ?>"><?php echo __(_("Forgot your password?")); ?></a>

							<input name="login" class="login-submit" type="submit" value="<?php echo __(_("Login")); ?>" />
						</fieldset>
					</form>
				</div>

				<div id="top-box-profile" class="toggle">
					<div class="top-box-profile">
						<div style="float: left; width: 90px;">
							<img src="<?php echo path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), TRUE); ?>" alt="<?php echo SESSION("ZanUser"); ?>" />
						</div>

						<div style="float: left; width: 170px; line-height: 15px;">
							<span class="bold"><?php echo SESSION("ZanUserName"); ?></span> <br />
							<span class="small grey"><a href="#"><?php echo __(_("See my profile page")); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>
							
							<span class="small grey"><a href="#"><?php echo __(_("Direct Messages")); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __(_("Help")); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><strong><?php echo __(_("My codes")); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __(_("My jobs")); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __(_("My posts")); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __(_("My courses")); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __(_("My points")); ?></strong>: 0</span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="#"><?php echo __(_("Publish a code")); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __(_("Publish a job")); ?></a></span><br />
							<span class="small grey"><a href="<?php echo path("bookmarks/add"); ?>"><?php echo __(_("Publish a bookmark")); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __(_("Publish a post")); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="#"><?php echo __(_("Update my Resume")); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<?php
								if(SESSION("ZanUserPrivilegeID") <= 2) {
								?>
									<span class="small grey"><a href="<?php echo path("cpanel"); ?>"><?php echo __(_("Go to CPanel")); ?></a></span><br />
								<?php
								}
							?>

							<span class="small grey"><a href="<?php echo path("users/logout"); ?>"><?php echo __(_("Logout")); ?></a></span><br />
						</div>

						<div class="clear"></div>
					</div>
				</div>

				<div id="top-box">
					<ul>
						<?php
							if(!SESSION("ZanUser")) {
						?>
								<li class="float-right">
									<a id="display-login" href="#" title="<?php echo __(_("Login")); ?>">
										<?php echo __(_("Login")); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" />
									</a>
								</li>
								
								<li class="float-right">
									<a id="display-register" href="#" title="<?php echo __(_("Register!")); ?>">
										<?php echo __(_("Register!")); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" />
									</a>
								</li>
						<?php
							} else {
						?>
								<li class="float-right">
									<a id="display-profile" href="#" title="<?php echo __(_("Hi")); ?>">
										<?php echo __(_("Hi")) .', <span style="color: #00a0ff">'. SESSION("ZanUser") .'</span>'; ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" />
									</a>
								</li>
						<?php
							}
						?>
						
						<li class="float-right">
							<a id="display-languages" href="#" title="<?php echo __(_("Language")); ?>">
								<?php echo getLanguage(whichLanguage(), TRUE); ?> <?php echo __(_("Language")); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" />
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="clear"></div>
		</div>

		<div id="wrapper">
			<div id="logo">
				<h1>CodeJobs</h1>
			</div>

			<nav>
				<ul>
					<li><a href="<?php echo path("blog/tag/ajax"); ?>">Ajax</a></li>
					<li><a href="<?php echo path("blog/tag/android"); ?>">Android</a></li>
					<li><a href="<?php echo path("blog/tag/backbone"); ?>">Backbone.js</a></li>
					<li><a href="<?php echo path("blog/tag/codeigniter"); ?>">CodeIgniter</a></li>
					<li><a href="<?php echo path("blog/tag/css3"); ?>">CSS3</a></li>
					<li><a href="<?php echo path("blog/tag/databases"); ?>">Databases</a></li>
					<li><a href="<?php echo path("blog/tag/emarketing"); ?>">eMarketing</a></li>
					<li><a href="<?php echo path("blog/tag/git-and-github"); ?>">Git &amp; Github</a></li>
					<li><a href="<?php echo path("blog/tag/html5"); ?>">HTML5</a></li>
					<li><a href="<?php echo path("blog/tag/ios"); ?>">iOS</a></li>
					<li><a href="<?php echo path("blog/tag/java"); ?>">Java</a></li>
					<li><a href="<?php echo path("blog/tag/javascript"); ?>">Javascript</a></li>
					<li><a href="<?php echo path("blog/tag/jquery"); ?>">jQuery</a></li>
					<li><a href="<?php echo path("blog/tag/mongodb"); ?>">MongoDB</a></li>
					<li><a href="<?php echo path("blog/tag/mysql"); ?>">MySQL</a></li>
					<li><a href="<?php echo path("blog/tag/nodejs"); ?>">Node.js</a></li>
					<li><a href="<?php echo path("blog/tag/php"); ?>">PHP</a></li>
					<li><a href="<?php echo path("blog/tag/python"); ?>">Python</a></li>
					<li><a href="<?php echo path("blog/tag/ruby"); ?>">Ruby</a></li>
					<li><a href="<?php echo path("blog/tag/ror"); ?>">RoR</a></li>
					<li><a href="<?php echo path("blog/tag/social-media"); ?>">Social Media</a></li>		
					<li><a href="<?php echo path("blog/tag/zanphp"); ?>">ZanPHP</a></li>
				</ul>
			</nav>
		</div>
	</header>

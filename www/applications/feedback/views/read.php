<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if($data) {
		$ID      = $data[0]["ID_Feedback"];
		$name    = $data[0]["Name"];
		$email   = $data[0]["Email"];
		$company = $data[0]["Company"];
		$phone   = $data[0]["Phone"];
		$subject = $data[0]["Subject"];
		$message = $data[0]["Message"];
		$date    = $data[0]["Text_Date"];
		$state   = $data[0]["Situation"];
		$back    = path(whichApplication() . _sh . "cpanel" . _sh . "results");
	} else {
		redirect(path(whichApplication() . _sh . "cpanel" . _sh . "results"));
	}
?>

<div class="add-form">
	<p class="field">
		<strong><?php echo __(_("Name")); ?></strong><br />
		<?php echo $name;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Email")); ?></strong><br />
		<?php echo $email;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Date")); ?></strong><br />
		<?php echo $date;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Subject")); ?></strong><br />
		<?php echo $subject;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Phone")); ?></strong><br />
		<?php echo $phone;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Company")); ?></strong><br />
		<?php echo $company;?>
	</p>
	
	<p class="field">
		<strong><?php echo __(_("Message")); ?></strong><br />
		<?php echo $message;?>
	</p>
	
	<p>
		<a href="<?php echo $back;?>" title="<?php echo __(_("Back")); ?>"><?php echo __(_("Back"));?></a>
	</p>
</div>
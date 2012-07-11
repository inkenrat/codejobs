$(document).ready(function() {
	$("#display-languages").on("click", function() {
		$("#top-box-register").hide();
		$("#top-box-login").hide();
			$("#top-box-languages").slideToggle("slow");
	});

	$("#display-register").on("click", function() {
		$("#top-box-languages").hide();
		$("#top-box-login").hide();
			$("#top-box-register").slideToggle("slow");
	});

	$("#display-login").on("click", function() {
		$("#top-box-register").hide();
		$("#top-box-languages").hide();
			$("#top-box-login").slideToggle("slow");		
	});

	$("#display-profile").on("click", function() {
		$("#top-box-languages").hide();
			$("#top-box-profile").slideToggle("slow");
	});

	$("#register-name").one("click", function() {
		$("#register-name").val("");
	});

	$("#register-email").one("click", function() {
		$("#register-email").val("");
	});

	$("#register-password").one("click", function() {
		$("#register-password").val("");
	});

	$("#login-username").one("click", function() {
		$("#login-username").val("");
	});

	$("#login-password").one("click", function() {
		$("#login-password").val("");
	});

	$(this).mouseup(function(login) {
		if(!($(login.target).parents('.toggle').length > 0)) {
			$(".toggle").hide();
			}
	});
	
	$("#username").focus();	
});
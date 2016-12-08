$(document).ready(function() {
	
	if ($("html").width() < 768) {
		$("#title").insertAfter("#links");
		$("#links").insertBefore("#title");
	}

	$("#btn_pic").click(function() {
		$("#feature_pic").toggle();
		$("#feature_email").hide();
		$("#feature_pass").hide();
		return false;
	});
	$("#btn_email").click(function() {
		$("#feature_pic").hide();
		$("#feature_email").toggle();
		$("#feature_pass").hide();
		return false;
	});
	$("#btn_pass").click(function() {
		$("#feature_pic").hide();
		$("#feature_email").hide();
		$("#feature_pass").toggle();
		return false;
	});
});
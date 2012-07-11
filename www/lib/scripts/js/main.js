$(document).on("ready", function() {
	//Alerts
	$("#alert-message").delay(5000).fadeOut(2000);

	$("#alert-message").on("click", function() {
		$("#alert-message").hide();
	});

	//External links
	$(function() {
		$('a[rel*=external]').click(function() {
			window.open(this.href);
			
			return false;
		});
	});
});	

//Checkbox
function checkAll(idForm) {
	$("form input:checkbox").attr("checked", "checked");
}

function unCheckAll(idForm) {
	$("form input:checkbox").removeAttr("checked");
}

//TinyMCE
function loadBasicTinyMCE() {
	tinyMCE.init({
		mode : "exact",
		elements : "editor",
		theme : "simple",
		editor_selector : "mceSimple"
	});
}

function loadAdvanceTinyMCE() {
	tinyMCE.init({
		mode : "exact",
		elements : "editor",
		theme : "advanced",
		skin : "o2k7",
		cleanup: true,
		plugins : "videos,advcode,safari,pagebreak,style,advhr,advimage,advlink,emotions,preview,media,fullscreen,template,inlinepopups,advimage,media,paste",              
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,videos,image,advcode,|,forecolor,|,charmap,|,pastetext,pasteword,pastetext,fullscreen,pagebreak,preview",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,
		convert_urls : false,                    
		content_CSS : "css/content.css",               
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
}

function insertHTML(content) {
	parent.tinyMCE.execCommand('mceInsertContent', false, content);
}
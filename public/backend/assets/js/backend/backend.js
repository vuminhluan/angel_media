$(document).ready(function() {
	var msg = $('.msg-from-server').html().trim();
	if (msg) {
		new Noty({
			text: msg,
			layout:"top",
			type: 'info',
			closeWith: ['button', 'click'],
			animation: {
				open: "animated slideInDown",
				close: "animated slideOutUp"
			},
			modal: true,
		}).show();
	}
});

// stand alone file manager
$(document).ready(function() {
	$('.change-avatar-btn').fancybox({	
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
		'autoScale'    	: false
	});
});
function responsive_filemanager_callback(field_id){
  var src = $('#'+field_id).val();
  $('img.'+field_id).attr('src', src);
  $.fancybox.close();
}
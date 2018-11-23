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
	if ($('.change-avatar-btn')[0]) {
		$('.change-avatar-btn').fancybox({	
			'width'		: 900,
			'height'	: 600,
			'type'		: 'iframe',
			'autoScale'    	: false
		});
	}
});
function responsive_filemanager_callback(field_id){
  var src = $('#'+field_id).val();
  $('img.'+field_id).attr('src', src);
  $.fancybox.close();
}



// Datatable Danh sách thành viên
$(document).ready(function() {
 	//---------------------------------------------------
 	if ($('#userlist-datatable')[0]) {
	 	var table = $('#userlist-datatable').DataTable( {
	 		"processing": true,
	 		"serverSide": true,
	 		"ajax": baseUrl+"/admin/users/datatable_json",
	 		"order": [[2,'desc']],
	 		"columnDefs": [
		 		{ "targets": 0, "name": "U.id", 'searchable':true, 'orderable':true},
		 		{ "targets": 1, "name": "email", 'searchable':true, 'orderable':true,},
		 		{ "targets": 2, "name": "created_at", 'searchable':true, 'orderable':true,},
		 		{ "targets": 3, "name": "status", 'searchable':false, 'orderable':false,},
		 		{ "targets": 4, "name": "group_name", 'searchable':true, 'orderable':true,},
		 		{ "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,},
	 		]
	 	});
 	}
 });
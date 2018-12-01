
var datatableLanguage = {
	"lengthMenu": "Hiển thị _MENU_ dòng",
	"zeroRecords": "Không có dữ liệu",
	// "info": "Showing page _PAGE_ of _PAGES_",
	"info": "Từ dòng _START_ tới _END_ của _TOTAL_ dòng",
	"infoEmpty": "Không có dữ liệu",
	"search": "Tìm kiếm",
	"paginate" : {
		"first": "Đầu",
		"last": "Cuối",
		"next": "Sau",
		"previous": "Trước"
	}
	// "infoFiltered": "(filtered from _MAX_ total records)"
};

// Active sidebar menu
$(document).ready(function() {
	var tab = $('input#menu_tab').val();
	if (tab) {
		var tabs = tab.split(',');
		if (tabs[0]) {
			var primaryTab = $('.side-navbar li[data-primary-tab='+tabs[0]+']');
			$(primaryTab).addClass('active');
			$(primaryTab).children('ul').addClass('show');
		}
		if (tabs[1]) {
			var secondaryTab = $('.side-navbar li[data-secondary-tab='+tabs[1]+']');
			$(secondaryTab).children('a').addClass('active');
		}
	}
});


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
	if ($('.stand-alone-filemanager')[0]) {
		$('.stand-alone-filemanager').fancybox({
			'width'		  : 900,
			'height'	  : 600,
			'type'		  : 'iframe',
			'autoScale' : false
		});
	}
});
function responsive_filemanager_callback(field_id){
  var src = $('#'+field_id).val();
  $('img.'+field_id).attr('src', src);
  $.fancybox.close();
}





// Tinymce textarea
$(document).ready(function() {
	if($(".tinymce_content").length > 0) {
		tinymce.init({

			selector: "textarea.tinymce_content",
			theme: "modern",
			height:200,
			fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
			plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor ",
			"responsivefilemanager"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor| responsivefilemanager | sizeselect | fontselect | fontsizeselect",
			style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			],

			relative_urls:false,
			filemanager_title: "Angel Media - File Manager",
			external_filemanager_path: baseUrl+"/filemanager/",
			external_plugins: { "filemanager" : baseUrl+"filemanager/plugin.min.js"}
		});
	}
});



// Datatable Danh sách thành viên
$(document).ready(function() {
 	//---------------------------------------------------
 	if ($('#user_list_datatable')[0]) {
	 	var table = $('#user_list_datatable').DataTable( {
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
 		$('#user_list_datatable').on('click', '.btn.btn-info.btn-square', function(event) {
	 		event.preventDefault();
	 		keyword = $(this).html();
	 		$('input[type=search]').val(keyword);
	 		// table.fnFilter(keyword,4,true,false);
	 		table.search(keyword).draw();
	 	});
 	}


});

// Datatable Danh sách nhóm thành viên
$(document).ready(function() {
 	//---------------------------------------------------
 	if ($('#user_group_list_datatable')[0]) {
	 	var table = $('#user_group_list_datatable').DataTable( {
			"language" : datatableLanguage,
	 		"processing": true,
	 		"serverSide": true,
	 		"ajax": baseUrl+"/admin/user-groups/datatable_json",
	 		"order": [[1,'asc']],
	 		"columnDefs": [
		 		{ "targets": 0, "name": "no", 'searchable':false, 'orderable':false},
		 		{ "targets": 1, "name": "group_name", 'searchable':true, 'orderable':true,},
		 		{ "targets": 2, "name": "Chức năng", 'searchable':false, 'orderable':false,},
	 		]
	 	});
 	}


});

// Xóa nhóm thành viên
$(document).ready(function() {
	$('table#user_group_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var groupName = $(this).attr('data-group-name') ? '"'+$(this).attr('data-group-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa nhóm: '+groupName+' ? Nếu xóa sẽ không thể khôi phục lại được. Tất cả thành viên trong nhóm sẽ được chuyển tới nhóm "Thành viên"',
			layout:'centerRight',
			buttons: [
				Noty.button('Xóa', 'btn btn-danger', function () {
					window.location.href=href;
				}, {id: 'button1', 'data-status': 'ok'}),

				Noty.button('Bỏ qua', 'btn btn-success', function () {
					deleteNoty.close();
				})
			]
		});
		deleteNoty.show();

	});
});



// Tạo alias cho 1 chuỗi tin tức (Trang thêm danh mục và trang sửa danh mục)
$(document).ready(function() {
	$('input.unicode').keyup(function(event) {
		var unicodeString = $(this).val();
		var prefix = $('input.alias').attr('data-alias-prefix');
		// alert(prefix); return;

		if (unicodeString) {
			$.ajax({
				url: baseUrl + 'ajax/create-alias',
				type: 'GET',
				data: {'unicode' : unicodeString},
				success: function(response) {
					alias = response.trim();
					$('input.alias').val(prefix+alias);
				}
			})
		} else {
			$('input.alias').val(prefix);
		}
	});
});


// Datatable Danh sách danh mục tin tức
$(document).ready(function() {
 	//---------------------------------------------------
 	if ($('#news_category_list_datatable')[0]) {
	 	var table = $('#news_category_list_datatable').DataTable( {
			"language" : datatableLanguage,
	 		"processing": true,
	 		"serverSide": true,
	 		"ajax": baseUrl+"/admin/news/category/datatable_json",
	 		// "order": [[2,'desc']],
	 		"columnDefs": [
		 		{ "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
		 		{ "targets": 1, "name": "name", 'searchable':true, 'orderable':true,},
		 		{ "targets": 2, "name": "alias", 'searchable':true, 'orderable':true,},
		 		{ "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,},
	 		]
	 	});
 		// $('#news_category_list_datatable').on('click', '.btn.btn-info.btn-square', function(event) {
	 	// 	event.preventDefault();
	 	// 	keyword = $(this).html();
	 	// 	$('input[type=search]').val(keyword);
	 	// 	// table.fnFilter(keyword,4,true,false);
	 	// 	table.search(keyword).draw();
	 	// });
 	}
});

// Xóa danh mục tin tức
$(document).ready(function() {
	$('table#news_category_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var categoryName = $(this).attr('data-category-name') ? '"'+$(this).attr('data-category-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa danh mục: '+categoryName+' ? Nếu xóa sẽ không thể khôi phục lại được',
			layout:'centerRight',
			buttons: [
				Noty.button('Xóa', 'btn btn-danger', function () {
					window.location.href=href;
				}, {id: 'button1', 'data-status': 'ok'}),

				Noty.button('Bỏ qua', 'btn btn-success', function () {
					deleteNoty.close();
				})
			]
		});
		deleteNoty.show();

	});
});

// ======================= TIN TỨC ========================= //

// Datatable Danh sách tin tức
$(document).ready(function() {
 	//---------------------------------------------------
 	if ($('#news_list_datatable')[0]) {
	 	var table = $('#news_list_datatable').DataTable( {
			"language" : datatableLanguage,
	 		"processing": true,
	 		"serverSide": true,
	 		"ajax": baseUrl+"/admin/news/datatable_json",
	 		"order": [[0,'asc']],
	 		"columnDefs": [
		 		{ "targets": 0, "name": "N.id", 'searchable':true, 'orderable':true},
		 		{ "targets": 1, "name": "N.name", 'searchable':true, 'orderable':true,},
		 		{ "targets": 2, "name": "N.alias", 'searchable':true, 'orderable':true,},
		 		{ "targets": 3, "name": "NC.name", 'searchable':true, 'orderable':true,},
		 		{ "targets": 4, "name": "N.created_at", 'searchable':true, 'orderable':true,},
		 		{ "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,},
	 		]
	 	});
 		// $('#news_list_datatable').on('click', '.btn.btn-info.btn-square', function(event) {
	 	// 	event.preventDefault();
	 	// 	keyword = $(this).html();
	 	// 	$('input[type=search]').val(keyword);
	 	// 	// table.fnFilter(keyword,4,true,false);
	 	// 	table.search(keyword).draw();
	 	// });
 	}
});

// Xóa tin tức
$(document).ready(function() {
	$('table#news_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var newsName = $(this).attr('data-news-name') ? '"'+$(this).attr('data-news-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa tin tức: '+newsName+' ? Nếu xóa sẽ không thể khôi phục lại được',
			layout:'centerRight',
			buttons: [
				Noty.button('Xóa', 'btn btn-danger', function () {
					window.location.href=href;
				}, {id: 'button1', 'data-status': 'ok'}),

				Noty.button('Bỏ qua', 'btn btn-success', function () {
					deleteNoty.close();
				})
			]
		});
		deleteNoty.show();

	});
});


// ======================== MENU ======================== //
// Recursive MENU - table
$(document).ready(function() {
	var menu = $('table#menu_list tbody tr');
	var margin = 0;
	$(menu).each(function(index, item) {
		margin = ($(item).attr('data-lv') - 1) * 20;
		$(item).find('td.menu-name').css('padding-left', margin);
	});
});


// Recursive MENU - select option
$(document).ready(function() {
	var menu = $('select.select-menu-parent option');
	var lv = 0;
	$(menu).filter("[data-lv=1]").css('color', '#dc3545');
	$(menu).each(function(index, item) {
		lv = ($(item).attr('data-lv') - 1);
		for (var i = 0; i < lv; i++) {
			$(item).prepend('&nbsp;&nbsp;&nbsp;&nbsp;');
		}
		// console.log(item);
	});
});

// Phát sinh vị trí khi chọn menu cha
$(document).ready(function () {
	var menuParentID = $('select[name=select_menu_parent]').attr('data-parent') ? $('select[name=select_menu_parent]').attr('data-parent') : 0;
	var exceptionID = $('select[name=select_menu_parent]').attr('data-exception') ? $('select[name=select_menu_parent]').attr('data-exception') : 0;
	// alert(exceptionID); return;

	get_children(menuParentID);
	function get_children(menuParentID = 0) {
		var url = baseUrl+'ajax/get-menu-children-by-parent-id/'+menuParentID+'/'+exceptionID;
		$('.create-menu-form select[name=select_orders]').load(url, function (response, status, request) {
			// alert('load vi tri thanh cong');
			var orderValue = $('select[name=select_orders]').attr('data-order');
			if (orderValue) {
				$('.create-menu-form select[name=select_orders] option[value='+orderValue+']').prop('selected', true);
			}
			console.log(response);
		});
	}

	$('select[name=select_menu_parent]').change(function () {
		var menuParentID = $(this).val();
		get_children(menuParentID);
	});
});


// Delete menu Xóa menu
$(document).ready(function() {
	$('table#menu_list').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var menuName = $(this).attr('data-menu-name') ? '"'+$(this).attr('data-menu-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa tin tức: '+menuName+' ? Nếu xóa sẽ không thể khôi phục lại được',
			layout:'centerRight',
			buttons: [
				Noty.button('Xóa', 'btn btn-danger', function () {
					window.location.href=href;
				}, {id: 'button1', 'data-status': 'ok'}),

				Noty.button('Bỏ qua', 'btn btn-success', function () {
					deleteNoty.close();
				})
			]
		});
		deleteNoty.show();

	});
});


// Chỉnh sửa menu - lấy ra vị trí đã chọn
$(document).ready(function() {
	// var orderValue = $('select[name=select_orders]').attr('data-order');
	// if (orderValue) {
	// 	$('.create-menu-form select[name=select_orders] option[value='+orderValue+']').prop('selected', true);
	// }
	// console.log($('.create-menu-form select[name=select_orders] option').html());
});

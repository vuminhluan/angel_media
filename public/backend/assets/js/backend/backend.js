
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
			timeout: 2000,
			animation: {
				open: "animated slideInDown",
				close: "animated slideOutUp"
			},
			modal: false,
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


// ========================= Trang nội dung ============================= //

// Datatable Danh sách Trang nội dung
$(document).ready(function() {
	//---------------------------------------------------
	if ($('#landing_list_datatable')[0]) {
		var table = $('#landing_list_datatable').DataTable( {
			"language" : datatableLanguage,
			"processing": true,
			"serverSide": true,
			"ajax": baseUrl+"/admin/landing/datatable_json",
			"order": [[3,'DESC']],
			"columnDefs": [
				{ "targets": 0, "name": "L.id", 'searchable':true, 'orderable':true},
				{ "targets": 1, "name": "L.name", 'searchable':true, 'orderable':true,},
				{ "targets": 2, "name": "L.alias", 'searchable':true, 'orderable':true,},
				{ "targets": 3, "name": "L.created_at", 'searchable':true, 'orderable':true,},
				{ "targets": 4, "name": "L.status", 'searchable':false, 'orderable':true,},
				{ "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,},
			]
		});
	}
});

// Xóa Trang nội dung
$(document).ready(function() {
	$('table#landing_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var landing_name = $(this).attr('data-landing-name') ? '"'+$(this).attr('data-landing-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa Trang: '+landing_name+' ? Nếu xóa sẽ không thể khôi phục lại được.',
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


// SLIDESHOW
// Datatable Danh sách nhóm thành viên
$(document).ready(function() {
	//---------------------------------------------------
	if ($('#slideshow_datatable')[0]) {
		var table = $('#slideshow_datatable').DataTable( {
			"language" : datatableLanguage,
			"processing": true,
			"serverSide": true,
			"ajax": baseUrl+"/admin/slideshow/datatable_json",
			"order": [[0,'desc']],
			"columnDefs": [
				{ "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
				{ "targets": 1, "name": "name", 'searchable':false, 'orderable':false,},
				{ "targets": 2, "name": "image", 'searchable':false, 'orderable':false,},
				{ "targets": 3, "name": "Chức năng", 'searchable':false, 'orderable':false,},
			]
		});
	}
});

// Xóa slide
$(document).ready(function() {
	$('table#slideshow_datatable').on('click', '.action-buttons .delete-action', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var slide_name = $(this).attr('data-slide-name') ? '"'+$(this).attr('data-slide-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa Slide: '+slide_name+' ? Nếu xóa sẽ không thể khôi phục lại được.',
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


//  ================= SẢN PHÂM ================ //
// Danh mục sản phẩm
// Datatable Danh sách danh mục sản phẩm
$(document).ready(function() {
	//---------------------------------------------------
	if ($('#product_category_list_datatable')[0]) {
		var table = $('#product_category_list_datatable').DataTable( {
			"language" : datatableLanguage,
			"processing": true,
			"serverSide": true,
			"ajax": baseUrl+"/admin/product/category/datatable_json",
			// "order": [[2,'desc']],
			"columnDefs": [
				{ "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
				{ "targets": 1, "name": "name", 'searchable':true, 'orderable':true,},
				{ "targets": 2, "name": "alias", 'searchable':true, 'orderable':true,},
				{ "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,},
			]
		});
	}
});


// Xóa danh mục sản phẩm
$(document).ready(function() {
	$('table#product_category_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
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


// END DANH MỤC SẢN PHẨM



// SẢN PHẨM
function unique(array) {
	var result = [];
	$.each(array, function(i, e) {
		if ($.inArray(e, result) == -1) result.push(e);
	});
	return result;
}
$(document).ready(function() {
	// Xóa 1 checkbox (màu sắc hoặc kích thước)
	$('#options_modal').on('click', '.remove-option-item', function(event) {
		event.preventDefault();
		var checkbox_to_delete = $(this).attr('data-parent');
		$('.'+checkbox_to_delete).remove();
	});

	// Thêm checkbox màu sắc
	$('.add-more-color').click(function(event) {
		var value = $('.add-more-color-value').val();
		var colors = $("input[name='color[]']");
		var num = colors.length + 1;
		if (!value) {
			return;
		}
		var checkbox = "<div class='mb-3 color"+num+"'> <div class='styled-checkbox'> <input value='"+value+"' type='checkbox' name='color[]' id='color"+num+"' checked disabled> <label for='color"+num+"'>"+value+" <i data-parent='color"+num+"' class='la la-times remove-option-item'></i> </label> </div> </div>";
		$('.color-box').append(checkbox);
	});

	// Thêm checkbox kích thước
	$('.add-more-size').click(function(event) {
		var value = $('.add-more-size-value').val();
		var sizes = $("input[name='size[]']");
		var num = sizes.length + 1;
		if (!value) {
			return;
		}
		var checkbox = "<div class='mb-3 size"+num+"'> <div class='styled-checkbox'> <input checked disable value='"+value+"' type='checkbox' name='size[]' id='size"+num+"' checked disabled> <label for='size"+num+"'>"+value+" <i data-parent='size"+num+"' class='la la-times remove-option-item'></i> </label> </div> </div>";
		$('.size-box').append(checkbox);
	});

	// Tạo phiên bản sản phẩm (màu sắc + kích thước + ...)
	$('.save-product-options-button').click(function(event) {
		// Lấy mảng màu sắc (các checkbox màu sắc đã được checked)
		var colors = $("input[name='color[]']").map(function() {
			return $(this).val();
		}).get();
		// Lấy mảng kích thước (các checkbox kích thước đã được checked)
		var sizes = $("input[name='size[]']").map(function() {
			return $(this).val();
		}).get();
		// Remove duplicate
		var colors_array = unique(colors);
		var sizes_array = unique(sizes);
		// console.log(colors_array);
		// console.log(sizes_array);

		var productName = $("input[name='name']").val();
		if (colors_array.length == 0 || sizes_array.length == 0 || !productName) {
			return;
		}

		$.ajax({
			url: baseUrl+'/ajax/create-products-version',
			type: 'GET',
			data: {
				color_str_list: colors_array.join(','),
				size_str_list: sizes_array.join(','),
				product_name: productName
			}
		})
		.done(function(response) {
			console.log("success");
			alert('Tạo thành công');
			$('.size-bx > div, .color-box > div').remove();
			// $('#options_modal, .modal-backdrop').hide();
			// $('body').removeClass('modal-open');
			// $('body, html').focus();
			// Load bảng các phiên bản của sản phẩm
			$('.versions-table').html(response);
		})
		.fail(function(err) {
			console.log("error");
			alert("error");
		});

	});

	$('.versions-table').on('click', '.btn-remove-item', function(event) {
		var rowID = $(this).attr('data-rowid');
		$.ajax({
			url: baseUrl+'/ajax/remove-product-version',
			type: 'GET',
			data: {rowid: rowID}
		})
		.done(function(response) {
			console.log("success");
			alert('success');
			// Load bảng các phiên bản của sản phẩm
			$('.versions-table').html(response);
		})
		.fail(function(err) {
			console.log(err);
			alert('error');
		});

	});
});

// Datatable Danh sách sản phẩm
$(document).ready(function() {
	//---------------------------------------------------
	if ($('#product_list_datatable')[0]) {
		var table = $('#product_list_datatable').DataTable( {
			"language" : datatableLanguage,
			"processing": true,
			"serverSide": true,
			"ajax": baseUrl+"/admin/products/datatable_json",
			"order": [[0,'desc']],
			"columnDefs": [
				// { "targets": 0, "name": "P.id", 'searchable'    :true, 'orderable' :true},
				{ "targets": 0, "name": "PC.name", 'searchable' :true, 'orderable' :true},
				{ "targets": 1, "name": "P.name", 'searchable'  :true, 'orderable' :true},
				{ "targets": 2, "name": "P.alias", 'searchable' :false, 'orderable':false},
				{ "targets": 3, "name": "P.image", 'searchable' :false, 'orderable':false},
				{ "targets": 4, "name": "version", 'searchable' :false, 'orderable':false},
				{ "targets": 5, "name": "Action", 'searchable'  :false, 'orderable':false},
			]
		});
	}
});

// XÓA SẢN PHẨM
$(document).ready(function() {
	// XÓA SẢN PHẨM:
	$('#product_list_datatable').on('click', '.action-buttons .delete-action', function(event) {
		// alert('a'); return;
		event.preventDefault();
		var href = $(this).attr('data-href');
		var productName = $(this).attr('data-product-name') ? '"'+$(this).attr('data-product-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa Sản phẩm '+productName+' ? Tất cả phiên bản cũng sẽ bị xóa và không thể khôi phục lại được',
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

// VERSIONS
$(document).ready(function() {
	var versionID = $('input[name=version_id]').val();
	$('.version-list').find('.version'+versionID).addClass('active');


	// XÓA PHIÊN BẢN:
	$('.update-product-version-form').on('click', '.delete-version-button', function(event) {
		event.preventDefault();
		var href = $(this).attr('data-href');
		var versionName = $(this).attr('data-version-name') ? '"'+$(this).attr('data-version-name')+'"' : 'này';
		var deleteNoty = new Noty({
			text: 'Bạn muốn xóa phiên bản: '+versionName+' ? Nếu xóa sẽ không thể khôi phục lại được',
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

//  ================= SẢN PHÂM ================ //

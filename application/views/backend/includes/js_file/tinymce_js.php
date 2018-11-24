<script>
	$(document).ready(function () {
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
				external_filemanager_path: baseUrl+"public/plugins/filemanager/",
				external_plugins: { "filemanager" : baseUrl+"public/plugins/filemanager/plugin.min.js"}
			});
		}
	});
</script>
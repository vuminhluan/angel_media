<?php

/**
 * 
 */
class Luan extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->library('image_lib');
		// $this->load->helper('text');
	}


	public function index() {
		$view_data = [
			'title' => "Crop image",
			'view' => "test"
		];
		$this->load->view('backend/layout', $view_data);
	}

	public function crop_image() {
		$image_config["image_library"] = "gd2";
		$image_config["source_image"] = 'D:/xampp/htdocs/admin.dev/source/test/test2.jpg';
		$image_config['new_image'] = 'D:/xampp/htdocs/admin.dev/source/test/test2_test.jpg';
		// $image_config['create_thumb'] = TRUE;
		$image_config['create_thumb'] = FALSE;
		$image_config['maintain_ratio'] = TRUE;
		$image_config['quality'] = "70%";
		$image_config['width'] = 3000;
		// $image_config['height'] = 400;

		$this->load->library('image_lib');
		$this->image_lib->initialize($image_config);
		if(!$this->image_lib->resize()) { //Resize image
			echo "Không thể resize";
		} else {
			echo "Resize thành công. Check it out !!";
		}

	}

	public function watermake_image() {
		$config['source_image'] = 'D:/xampp/htdocs/admin.dev/source/avatars/avatar2_thumb.png';
		$config['wm_text'] = 'Copyright 2006 - John Doe';
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = 'C:/Windows/Fonts/ALGER.TTF';
		$config['wm_font_size'] = '10';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '0';

		$this->image_lib->initialize($config);

		// $this->image_lib->watermark();
		if(!$this->image_lib->watermark()) { //Resize image
			echo "Không thể watermark";
		} else {
			echo "watermark thành công";
		}
	}

	public function convert_to_ascii($str = "Vũ Minh Luân") {
		// echo url_title(convert_accented_characters('Vũ Minh Luân'), 'dash', TRUE);
		echo make_alias($str);
	}

}
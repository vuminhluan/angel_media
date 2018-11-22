<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    function getGroupyName($id){
    	
    	$CI = & get_instance();
    	return $CI->db->get_where('ci_user_groups', array('id' => $id))->row_array()['group_name'];
    }

    function generate_code($amount = 6, $characters = '') {
    	if (empty($characters)) {
	    	$characters = 'abcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZ0123456789';
    	}
    	$code = '';
    	for ($i=0; $i < $amount; $i++) {
    		$position = mt_rand(0, strlen($characters)-1);
    		$code .= $characters[$position];
    	}
    	return $code;
    }

?>    
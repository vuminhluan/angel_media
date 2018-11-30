<?php

defined('BASEPATH') OR exit('No direct script access allowed');


function public_design($path = '') {
	return base_url('public/design/'.$path);
}

function assets($path='') {
	return base_url('public/'.$path);
}

function plugins($path='') {
	return base_url('public/plugins/'.$path);
}

/**
* @param: array of menu, parent_id - default: 0
*/

function get_recursive_menu($menu, $parent_id = 0, &$recursive_menu = [], $id = "id", $name = "name", $parent = "parent_id") {
	foreach ($menu as $item) {
		if ($item['parent_id'] == $parent_id) {
			// array_push($item, []);
			$item['submenu'] = [];
			$recursive_menu[$item['name']] = $item;
			get_recursive_menu($menu, $item[$id], $recursive_menu[$item['name']]['submenu']);
		}
	}
	return $recursive_menu;
}

function render_menu_tree($node) {
	if (count($node['submenu']) > 0) {
		echo "<ul class='submenu'>";
		foreach ($node['submenu'] as $submenu) {
			echo "<li><a href='".base_url($submenu['menu_link'])."'>".$submenu['menu_name']."</a>";
			render_menu_tree($submenu);
			echo "</li>";
		}
		echo "</ul>";
	}
}

function render_menu_table($node, &$i = 2) {
	if (count($node['submenu']) > 0) {
		foreach ($node['submenu'] as $submenu) {
			$status = $submenu['status'] ? "<span class='badge badge-success'>Hiện</span>" : "<span class='badge badge-dark'>Ẩn</span>";
			$action = '<div class="action-buttons td-actions text-right">
				<a href="'.base_url("admin/menu/".$submenu['id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
				<a data-menu-name="'.$submenu['name'].'" data-href="'.base_url("admin/menu/".$submenu['id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
			</div>';
			echo "<tr data-lv='".$i."' class='submenu".$i."'>";
			// echo "<td>".$submenu['id']."</td>";
			echo "<td class='menu-name'><span class='submenu-sign'>&#8627;</span> <span class='badge badge".$i."'>".$i." </span> ".$submenu['name']."</td>";
			echo "<td>".$submenu['link']."</td>";
			echo "<td>".$node['name']."</td>";
			echo "<td>".$node['orders']." - ".$submenu['orders']."</td>";
			echo "<td>".$status."</td>";
			echo "<td>$action</td>";
			echo "</tr>";
		}
		$i++;
		render_menu_table($submenu, $i);
	}
}

function render_selection_menu($menu_list, $choosen_id = "", $i = 1)
{
	foreach ($menu_list as $key => $menu) {
		echo "<option data-lv='".$i."' value='".$menu['id']."' ";
		if ($choosen_id && $choosen_id == $menu['id']) {
			echo "selected";
		}
		echo ">";
		if ($menu['parent_id'] != 0) {
			echo "&#8627;";
		}
		echo $menu['name']."</option>";
		if (count($menu['submenu']) > 0) {
			$i++;
			render_selection_menu($menu['submenu'], $choosen_id, $i);
			$i = 1;
		}
	}

	// echo "<option>------------------</option>";
}


// function getSubmenu($menu, $parent_id) {
// 	$submenu = [];
// 	foreach ($menu as $menu_item) {
// 		if ($menu_item['menu_parent_id'] == $parent_id) {
// 			$submenu[] = $menu_item;
// 		}
// 	}
// 	return $submenu;
// }

// function testHelper($recursive_menu = ['1,2,3']) {
// 	return $recursive_menu;
// }



function server_path($value='') {
	return str_replace(basename($_SERVER["SCRIPT_FILENAME"]),"",$_SERVER["SCRIPT_FILENAME"]);
}

function make_alias($string) {
	// url helper : url_title
	// text helper : convert
	return url_title(convert_accented_characters($string), 'dash', TRUE);
}

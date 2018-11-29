<?php

defined('BASEPATH') or exit('No direct script access allowed');

function public_design($path = '')
{
  return base_url('public/design/' . $path);
}

function assets($path = '')
{
  return base_url('public/' . $path);
}

function plugins($path = '')
{
  return base_url('public/plugins/' . $path);
}

/**
 * @param: array of menu, parent_id - default: 0
 */

function get_recursive_menu($menu, $parent_id = 0, &$recursive_menu = [])
{
  foreach ($menu as $item) {
    if ($item['menu_parent_id'] == $parent_id) {
      // array_push($item, []);
      $item['submenu'] = [];
      $recursive_menu[$item['menu_name']] = $item;
      get_recursive_menu($menu, $item['menu_id'], $recursive_menu[$item['menu_name']]['submenu']);
    }
  }
  return $recursive_menu;
}

function render_menu_tree($node)
{
  if (count($node['submenu']) > 0) {
    echo "<ul class='submenu'>";
    foreach ($node['submenu'] as $submenu) {
      echo "<li><a href='" . base_url($submenu['menu_link']) . "'>" . $submenu['menu_name'] . "</a>";
      render_menu_tree($submenu);
      echo "</li>";
    }
    echo "</ul>";
  }
}

// function getSubmenu($menu, $parent_id) {
//   $submenu = [];
//   foreach ($menu as $menu_item) {
//     if ($menu_item['menu_parent_id'] == $parent_id) {
//       $submenu[] = $menu_item;
//     }
//   }
//   return $submenu;
// }

// function testHelper($recursive_menu = ['1,2,3']) {
//   return $recursive_menu;
// }

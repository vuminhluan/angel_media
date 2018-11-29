<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



// ========= ========= ADMIN ROUTES ========= ========= //


// Login
$route['admin/login'] = 'backend/auth/render_login_page';

// Register
$route['admin/register'] = 'backend/auth/render_register_page';

// Forgot Password
$route['admin/forgot-password'] = 'backend/auth/render_forgot_password_page';

// Reset Password
$route['admin/reset-password'] = 'backend/auth/render_reset_password_page';
$route['admin/reset-password-by-code'] = 'backend/auth/reset_password_by_code';

// Confirm email
$route['admin/confirm-email'] = 'backend/auth/render_confirm_email_page';
$route['admin/send-confirmation-email'] = 'backend/auth/send_confirmation_email';
$route['admin/resend-confirmation-email'] = 'backend/auth/resend_confirmation_email';

// Logout - Đăng xuất
$route['admin/logout'] = 'backend/auth/logout';

// Verify email - Xác nhận email - Kích hoạt tài khoản.
$route['admin/confirm-verification/(:any)'] = 'backend/auth/confirm_verification/$1';

// Admin Dashboard - index
$route['admin'] = 'backend/dashboard';
$route['admin/dashboard'] = 'backend/dashboard';

// Dashboard - User : profile, update profile, ...
$route['admin'] = 'backend/dashboard';
$route['admin/profile'] = 'backend/user/render_profile_page';
$route['admin/profile/update/info'] = 'backend/user/update_personal_information';
$route['admin/profile/update/password'] = 'backend/user/update_password';
$route['admin/profile/update/avatar'] = 'backend/user/update_avatar';


// Dashboard - User : Danh sách user, chỉnh sửa user, ...
$route['admin/users'] = 'backend/user/render_user_list_page';
$route['admin/users/datatable_json'] = 'backend/user/user_list_datatable_json';

$route['admin/users/(:num)/edit'] = 'backend/user/render_edit_user_page/$1';
$route['admin/users/update'] = 'backend/user/update_user';

$route['admin/users/new'] = 'backend/user/render_create_user_page';
$route['admin/users/create'] = 'backend/user/create_user';

// Dashboard - User Group : Danh sách nhóm thành viên, chỉnh sửa nhóm thành viên, ...
$route['admin/user-groups'] = 'backend/user/render_user_group_list_page';
$route['admin/user-groups/datatable_json'] = 'backend/user/user_group_list_datatable_json';

$route['admin/user-groups/(:num)/delete'] = 'backend/user/delete_user_group/$1';
$route['admin/user-groups/(:num)/edit'] = 'backend/user/render_edit_user_group_page/$1';
$route['admin/user-groups/update'] = 'backend/user/update_user_group';

$route['admin/user-groups/new'] = 'backend/user/render_create_user_group_page';
$route['admin/user-groups/create'] = 'backend/user/create_user_group';

// Dashboard - News Category : Danh sách danh mục tin tức, chỉnh sửa Danh mục tin tức, ...
$route['admin/news/categories'] = 'backend/news/render_news_category_list_page';
$route['admin/news/category/datatable_json'] = 'backend/news/news_categories_datatable_json';

$route['admin/news/category/(:num)/delete'] = 'backend/news/delete_news_category/$1';
$route['admin/news/category/(:num)/edit'] = 'backend/news/render_edit_news_category_page/$1';
$route['admin/news/category/update'] = 'backend/news/update_news_category';

$route['admin/news/category/new'] = 'backend/news/render_create_news_category_page';
$route['admin/news/category/create'] = 'backend/news/create_news_category';


// Dashboard - News : Danh sách tin tức, chỉnh sửa tin tức, ...
$route['admin/news'] = 'backend/news/render_news_list_page';
$route['admin/news/datatable_json'] = 'backend/news/news_datatable_json';

$route['admin/news/(:num)/delete'] = 'backend/news/delete_news/$1';
$route['admin/news/(:num)/edit'] = 'backend/news/render_edit_news_page/$1';
$route['admin/news/update'] = 'backend/news/update_news';

$route['admin/news/new'] = 'backend/news/render_create_news_page';
$route['admin/news/create'] = 'backend/news/create_news';


// Dashboard - Menu : Danh sách menu, chỉnh sửa menu, ...
$route['admin/menu'] = 'backend/menu/render_menu_list_page';

$route['admin/menu/(:num)/delete'] = 'backend/menu/delete_menu/$1';
$route['admin/menu/(:num)/edit'] = 'backend/menu/render_edit_menu_page/$1';
$route['admin/menu/update'] = 'backend/menu/update_menu';

$route['admin/menu/new'] = 'backend/menu/render_create_menu_page';
$route['admin/menu/create'] = 'backend/menu/create_menu';


// AJAX ROUTE
$route['ajax/create-alias'] = 'ajax/create_alias';



// ========= ========= END ADMIN ROUTES ========= ========= //











































// ===================== BEGIN ROUTES TEST ===================== //
$route['test'] = 'Luan/index';
$route['test/crop_image'] = 'Luan/crop_image';
$route['test/wm_image'] = 'Luan/watermake_image';

// ===================== END ROUTES TEST ===================== //
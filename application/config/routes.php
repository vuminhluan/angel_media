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
$route['admin/users/datatable_json'] = 'backend/user/datatable_json';



// ========= ========= END ADMIN ROUTES ========= ========= //
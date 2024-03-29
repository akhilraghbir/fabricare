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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home';
$route['login'] = 'register/login';
$route['register'] = 'register';
$route['contact'] = 'home/contact';
$route['services'] = 'home/services';
$route['cart'] = 'home/cart';
$route['about'] = 'home/about';
$route['coupons'] = 'home/coupons';
$route['schedule-pickup'] = 'home/schedule_pickup';
$route['validatePincode'] = 'home/validatePincode';
$route['manage-address'] = 'home/manage_addresses';
$route['add-address'] = 'home/add_address';
$route['edit-address/(:num)'] = 'home/edit_address/$1';
$route['delete-address/(:num)'] = 'home/delete_address/$1';
$route['getProducts'] = 'home/getProducts';
$route['addtocart'] = 'home/addtocart';
$route['removecart'] = 'home/removecart';
$route['updateCart'] = 'home/updateCart';
$route['applyCoupon'] = 'home/applyCoupon';
$route['getCartCount'] = 'home/getCartCount';
$route['placeOrder'] = 'home/placeOrder';
$route['payment/(:any)'] = "razorpay/index/$1";
$route['order-success'] = "home/order_success";
$route['my-orders'] = 'home/my_orders';
$route['view-invoice/(:any)'] = 'home/view_invoice/$1';
$route['activate-account/(:any)'] = 'register/activate_account/$1';
$route['doLogout'] = 'register/logout';
$route['admin'] = 'login';
$route['forgot-password'] = 'login/forgotPassword';
$route['administrator/dashboard'] = 'administrator/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['terms-and-conditions'] = 'home/terms_and_conditions';
$route['refund-policy'] = 'home/refund_policy';
$route['privacy-policy'] = 'home/privacy_policy';
$route['cancellation-policy'] = 'home/cancellation_policy';
$route['forgot-password'] = 'home/forgot_password';


/* api routes */
$route['api/user-register'] = 'api/api/user_register';
$route['api/user-login'] = 'api/api/user_login';
$route['api/forgot-password'] = 'api/api/forgot_password';
$route['api/reset-password'] = 'api/api/reset_password';

$route['api/getBanners'] = 'api/dashboard/get_banners';
$route['api/getZipcodes'] = 'api/dashboard/get_zipcodes';

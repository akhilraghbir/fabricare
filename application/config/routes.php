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
$route['admin'] = 'login';
$route['forgot-password'] = 'login/forgotPassword';
$route['administrator/dashboard'] = 'administrator/dashboard';
$route['sign-contract/(:any)'] = 'Contracts/view/$1';
$route['load-contract-pdf/(:any)'] = 'Contracts/load_pdf/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* api routes */
$route['api/user-login'] = 'api/api/user_login';
$route['api/forgot-password'] = 'api/api/forgot_password';
$route['api/reset-password'] = 'api/api/reset_password';
$route['api/get-financial-years'] = 'api/dashboard/financial_years';
$route['api/get-categories'] = 'api/dashboard/categories';
$route['api/add-bill'] = 'api/dashboard/addBill';
$route['api/update-bill'] = 'api/dashboard/updateBill';
$route['api/list-bills'] = 'api/dashboard/listBills';
$route['api/get-bill'] = 'api/dashboard/getBill';
$route['api/delete-bill'] = 'api/dashboard/deleteBill';
$route['api/delete-attachment'] = 'api/dashboard/deleteAttachment';
$route['api/get-profile'] = 'api/dashboard/getProfile';
$route['api/update-profile'] = 'api/dashboard/updateProfile';
$route['api/update-password'] = 'api/dashboard/updatePasswod';
$route['api/post-enquiry'] = 'api/dashboard/postEnquiry';
$route['api/settings/(:any)'] = 'api/dashboard/getSettings/$1';
$route['api/add-tform'] = 'api/dashboard/addTform';
$route['api/get-tform'] = 'api/dashboard/getTform';
$route['api/list-tform'] = 'api/dashboard/listTforms';
$route['api/pie-chart'] = 'api/dashboard/dashboardPiechart';
$route['api/bar-graph'] = 'api/dashboard/dashboardBargraph';
$route['api/add-attachments'] = 'api/dashboard/addAttachments';



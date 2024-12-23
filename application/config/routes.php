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
// $route['Login/(:any)'] = 'catalog/product_lookup';
// function route_group($prefix, $routes) {
//     foreach ($routes as $key => $val) {
//         $GLOBALS['route'][$prefix . '/' . $key] = $val;
//     }
// }
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['beranda'] = 'Maincontroller/index';
$route['login-check'] = 'Login/start_session';
$route['form-input-barang'] = 'Maincontroller/form_input_barang';
$route['arrived'] = 'Maincontroller/arrived';
$route['received'] = 'Maincontroller/received';
$route['log-out'] = 'Maincontroller/logout';

$route['post-pengiriman'] = 'JqueryController/post_pengiriman';
$route['fetch-pengiriman'] = 'JqueryController/fetch_pengiriman';
$route['update-pengiriman'] = 'JqueryController/update_pengiriman';
$route['update-pengiriman-arived'] = 'JqueryController/update_pengiriman_arrived';
$route['add-user'] = 'JqueryController/add_user';

$route['form-csv'] = 'Maincontroller/form_csv';
$route['view-data-csv'] = 'Maincontroller/view_data_csv';
$route['export-data-csv'] = 'Maincontroller/export_data_csv';

$route['get-pengiriman'] = 'JqueryController/get_pengiriman';
$route['get-detail-user'] = 'JqueryController/get_detail_user';
$route['get-arrived'] = 'JqueryController/get_arrived';
$route['get-received'] = 'JqueryController/get_received';

// route_group('prefix', [
//     'post-pengiriman' => 'JqueryController/post_pengiriman',
// ]);
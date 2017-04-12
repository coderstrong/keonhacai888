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
| URI contains no data. In the above example, the 'welcome' class
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
$route['default_controller'] = 'frontend/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//home
$route['trang-chu'] = 'frontend/home';
$route['ket-qua-xo-so'] = 'frontend/home/ketquaxoso';

//tips
//$route['tips'] = 'frontend/LiveTips';
$route['tips'] = 'frontend/LiveTips/tips';
$route['tips/page/(:num)'] = 'frontend/LiveTips/tips/$1';

//truc-tiep-bd
$route['truc-tiep-bd'] = 'frontend/LiveFixture';
$route['truc-tiep/(:num)/(:any)'] = 'frontend/LiveFixture/livedetail/$1/$2';
$route['truc-tiep/(:num)/(:num)/(:any)'] = 'frontend/LiveFixture/livedetailbyserver/$1/$2/$3';

//news
$route['tin-tuc'] = 'frontend/LiveNews/tintuc';
$route['tin-tuc/page/(:num)'] = 'frontend/LiveNews/tintuc/$1';
$route['tin-tuc/(:num)/(:any)'] = 'frontend/LiveNews/tintuc/$1/$2';

$route['nhan-dinh'] = 'frontend/LiveNews/nhandinh';
$route['nhan-dinh/page/(:num)'] = 'frontend/LiveNews/nhandinh/$1';
$route['nhan-dinh/(:num)/(:any)'] = 'frontend/LiveNews/nhandinh/$1/$2';

$route['nha-cai-uy-tin'] = 'frontend/LiveDealer';
//Ajax
$route['ajax-videos'] = 'api/Ajaxvideos';

//dashboard
$route['dashboard'] = 'dashboard/home';
//logout
$route['dashboard/logout'] = 'dashboard/home/logout';
//change password
//$route['dashboard/changepassword'] = 'dashboard/login/changePassword';
//forgot password
//$route['dashboard/forgotpassword'] = 'dashboard/login/forgotPassword';



//RestFul
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8

//page
$route['(:any)'] = 'frontend/PageStatic/LoadContent/$1';
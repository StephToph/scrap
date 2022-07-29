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
$route['default_controller'] = 'user/login';

// The verification page
$route['paystack-verify'] = 'order/verify';
$route['prepare'] = 'salary/prepare';
$route['salary_rep'] = 'salary/salary_rep';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['branch'] = 'account/branch';
$route['debit_report'] = 'debit/debit_report';
$route['cost'] = 'expenses/cost';
$route['exp_report'] = 'expenses/exp_report';
$route['new_staff'] = 'staff/new';
$route['new_customer'] = 'customer/new';
$route['new_company'] = 'company/new';
$route['daily'] = 'scrap/new';
$route['category'] = 'scrap/category';
$route['prepared'] = 'scrap/prepared';
$route['directory'] = 'scrap/index';
$route['inward'] = 'cheque/inward';
$route['inward_report'] = 'cheque/inward_report';
$route['outward'] = 'cheque/outward';
$route['outward_report'] = 'cheque/outward_report';
$route['designation'] = 'staff/designation';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

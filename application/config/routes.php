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
$route['default_controller'] = 'Home_controller';
$route['aboutus'] = 'Home_controller/aboutus';
$route['staff'] = 'Home_controller/staff';
$route['advertisements'] = 'Home_controller/advertisement';
$route['advertisements/(:any)'] = 'Home_controller/advertisement';


$route['contactus'] = 'Home_controller/contactus';
$route['contactussubmit'] = 'Home_controller/contactussubmit';
$route['viewad/(:any)'] = 'Home_controller/viewad';



$route['Admin'] = 'Admin_controller/index';
$route['admin'] = 'Admin_controller/index';
$route['dashboard'] = 'Admin_controller/dashboard';
$route['advertisement'] = 'Ad_controller';
$route['archivedadvertisement'] = 'Ad_controller/archivedad';

$route['user'] = 'User_controller';
$route['bank'] = 'Bank_controller';
$route['tenants'] = 'Tenants_controller';
$route['units'] = 'Units_controller';
$route['buildings'] = 'Buildings_controller';
$route['owners'] = 'Owners_controller';
$route['expenses'] = 'Expenses_controller';
$route['payment'] = 'Payment_controller';
$route['receipt'] = 'Receipt_controller';
$route['report'] = 'Report_controller';

$route['suspendedcontractlist'] = 'Contracts_controller/suspendedcontractlist';
$route['endcontractlist'] = 'Contracts_controller/endcontractlist';


$route['tenantstatement'] = 'Statement_controller/tenantstatement';
$route['buildingstatement'] = 'Statement_controller/buildingstatement';
$route['revenuestatement'] = 'Statement_controller/revenuestatement';
$route['cashstatement'] = 'Statement_controller/cashstatement';
$route['bankstatement'] = 'Statement_controller/bankstatement';
$route['insurancestatement'] = 'Statement_controller/insurancestatement';




//$route['404_override'] = 'Error_controller';
$route['translate_uri_dashes'] = FALSE;

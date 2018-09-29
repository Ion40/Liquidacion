<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Home_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["IncomigData/(:any)/(:any)/(:any)"] = "Home_controller/getDataLiq/$1/$2/$3";

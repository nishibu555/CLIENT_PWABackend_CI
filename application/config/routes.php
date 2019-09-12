<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

/*
==================================================================
==================================================================
========================= Backend ================================
==================================================================
==================================================================
*/

$route['admin/dashboard'] = 'backend/DashboardController';


//login
$route['admin/login'] = 'backend/AdminLoginController';
$route['admin/check_login'] = 'backend/AdminLoginController/check_login';

//logout

$route['admin/logout'] = 'backend/LogoutController';

//clients

$route['clients'] = 'backend/ClientController';
$route['clients-list'] = 'backend/ClientController/client_list';
$route['client/add'] = 'backend/ClientController/add';
$route['client/save'] = 'backend/ClientController/save';
$route['client/show_me/(:any)'] = 'backend/ClientController/show_me/$1';
$route['client/hide_me/(:any)'] = 'backend/ClientController/hide_me/$1';
$route['client/edit/(:any)'] = 'backend/ClientController/edit/$1';
$route['client/update/(:any)'] = 'backend/ClientController/update/$1';
$route['client/delete/(:any)'] = 'backend/ClientController/destroy/$1';
$route['client/image_upload'] = 'backend/ClientController/image_upload';


//Porfolio section

$route['portfolio'] = 'backend/PortfolioController';
$route['portfolio-list'] = 'backend/PortfolioController/portfolio_list';
$route['portfolio/add'] = 'backend/PortfolioController/add';
$route['portfolio/save'] = 'backend/PortfolioController/save';
$route['portfolio/show_me/(:any)'] = 'backend/PortfolioController/show_me/$1';
$route['portfolio/hide_me/(:any)'] = 'backend/PortfolioController/hide_me/$1';
$route['portfolio/edit/(:any)'] = 'backend/PortfolioController/edit/$1';
$route['portfolio/update/(:any)'] = 'backend/PortfolioController/update/$1';
$route['portfolio/delete/(:any)'] = 'backend/PortfolioController/destroy/$1';
$route['portfolio/main_image_upload'] = 'backend/PortfolioController/main_image_upload';
$route['portfolio/main_image_remove'] = 'backend/PortfolioController/main_image_remove';
$route['portfolio/secondary_image_upload'] = 'backend/PortfolioController/secondary_image_upload';
$route['portfolio/secondary_image_remove'] = 'backend/PortfolioController/secondary_image_remove';
$route['portfolio/image_remove_from_server'] = 'backend/PortfolioController/image_remove_from_server';

$route['portfolio/category'] = 'backend/PortfolioController/allCategory';
$route['portfolio-category-list'] = 'backend/PortfolioController/get_category_data';
$route['portfolio/category/add'] = 'backend/PortfolioController/category_add';
$route['portfolio/category/save'] = 'backend/PortfolioController/category_save';
$route['portfolio/category/edit/(:any)'] = 'backend/PortfolioController/category_edit/$1';
$route['portfolio/category/update/(:any)'] = 'backend/PortfolioController/category_update/$1';
$route['portfolio/category/delete/(:any)'] = 'backend/PortfolioController/category_destroy/$1';

//testimonial  section
$route['testimonial'] = 'backend/TestimonialController';
$route['testimonial-list'] = 'backend/TestimonialController/testimonial_list';
$route['testimonial/add'] = 'backend/TestimonialController/add';
$route['testimonial/save'] = 'backend/TestimonialController/save';
$route['testimonial/show_me/(:any)'] = 'backend/TestimonialController/show_me/$1';
$route['testimonial/hide_me/(:any)'] = 'backend/TestimonialController/hide_me/$1';
$route['testimonial/edit/(:any)'] = 'backend/TestimonialController/edit/$1';
$route['testimonial/update/(:any)'] = 'backend/TestimonialController/update/$1';
$route['testimonial/delete/(:any)'] = 'backend/TestimonialController/destroy/$1';
$route['testimonial/image_upload'] = 'backend/TestimonialController/image_upload';

//Settings - recapcha
$route['settings/recaptcha'] = 'backend/ApiSettingsController/recaptcha';
$route['recaptcha/update/(:any)'] = 'backend/ApiSettingsController/update_recaptcha/$1';

//admin settings
$route['admin/all'] = 'backend/AdminController';
$route['admin/get_all_admin_data'] = 'backend/AdminController/get_all_admin_data';
$route['admin/add'] = 'backend/AdminController/create';
$route['admin/save'] = 'backend/AdminController/save';
$route['admin/edit/(:any)'] = 'backend/AdminController/edit/$1';
$route['admin/update/(:any)'] = 'backend/AdminController/update/$1';
$route['admin/delete/(:any)'] = 'backend/AdminController/destroy/$1';

$route['admin/profile'] = 'backend/AdminController/profile';
$route['admin/change_password'] = 'backend/AdminController/change_password';

// Pages settings

$route['pages/contact'] = 'backend/PagesController/contact_us';
$route['pages/contact/update/(:any)'] = 'backend/PagesController/update_contact_us/$1';

$route['pages/about_us'] = 'backend/PagesController/about_us';

$route['pages/about_us/update/(:any)'] = 'backend/PagesController/update_about_us/$1';
$route['pages/about_us_image_upload'] = 'backend/PagesController/about_us_image_upload';


/*
==================================================================
==================================================================
========================= Frontend ================================
==================================================================
==================================================================
*/

<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/', 'Front::index');
$routes->get('/admin/categoryList', 'Admin::categoryList');



//Te ielikšu HTTP Request apstrādi
$routes->get('/admin/getcategory/(:any)', 'Admin::getCategoryById/$1');
$routes->get('/admin/deleteCategory/(:any)', 'Admin::deleteCategory/$1');
$routes->get('/admin/deleteNews/(:any)', 'Admin::deleteNews/$1');
$routes->get('/admin/getNewsById/(:any)', 'Admin::getNewsById/$1');
$routes->get('/admin/deleteComments/(:any)', 'Admin::deleteComments/$1');
$routes->get('/admin/getUser/(:any)', 'Admin::getUserById/$1');
$routes->get('/admin/deleteComments/(:any)', 'Admin::deleteComments/$1');
$routes->get('/admin/deleteUser/(:any)', 'Admin::deleteUser/$1');

$routes->get("/front/getFilterData","Front::getFilterData");

// Te apstrādājam POST request

$routes->post("/admin/saveCategory","Admin::saveCategory");
$routes->post("/admin/updateCategory/(:any)","Admin::updateCategory/$1");
$routes->post("/admin/saveNews","Admin::saveNews");
$routes->post("/admin/updateNews/(:any)","Admin::updateNews/$1");
$routes->post("/admin/saveUser","Admin::saveUser");
$routes->post("/admin/updateUser/(:any)","Admin::updateUser/$1");



//Pievieojam routes

// admin/categories,admin/news,admin/comments,admin/users

$routes->get('/admin/categories', 'Admin::categories');
$routes->get('/admin/news', 'Admin::news');
$routes->get('/admin/comments', 'Admin::comments');
$routes->get('/admin/users', 'Admin::users');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

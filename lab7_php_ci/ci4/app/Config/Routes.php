<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/about',   'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs',    'Page::faqs');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel',        'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel',                'Artikel::admin_index');
    $routes->add('artikel/add',            'Artikel::add');
    $routes->add('artikel/edit/(:num)',    'Artikel::edit/$1');
    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});
$routes->add('/user/login',  'User::login');
$routes->get('/user/logout', 'User::logout');

$routes->get('ajax',                   'AjaxArtikel::index');
$routes->get('ajax/getData',           'AjaxArtikel::getData');
$routes->delete('ajax/delete/(:num)', 'AjaxArtikel::delete/$1');
$routes->post('ajax/add',              'AjaxArtikel::add');
$routes->post('ajax/update/(:num)',    'AjaxArtikel::update/$1');

// ═══════════════════════════════════════════════════════
// REST API - POST
// ═══════════════════════════════════════════════════════

// GET - Bebas tanpa filter
$routes->get('post',             'Post::index');
$routes->get('post/(:any)',      'Post::show/$1');

// POST, PUT, DELETE - DIPROTEKSI filter apiauth
$routes->group('', ['filter' => 'apiauth'], function ($routes) {
    $routes->post('post',              'Post::create');
    $routes->put('post/(:segment)',    'Post::update/$1');
    $routes->delete('post/(:segment)', 'Post::delete/$1');
});

// API Login
$routes->post('api/login', 'Api\Auth::login');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ---------------------------------------------------------------
// Public portfolio routes
// ---------------------------------------------------------------
$routes->get('/',                   'pages::home');
$routes->get('home',                'pages::home');
$routes->get('about',               'pages::about');
$routes->get('projects',            'pages::projects');
$routes->get( 'contact',            'pages::contact');
$routes->post('contact/send',       'pages::sendContact');
$routes->get('credit',              'pages::credit');
$routes->get('news',                'pages::news');
$routes->get('gallery',             'pages::gallery');
$routes->get('news/(:num)',         'pages::article_detail/$1');
$routes->get('article/(:num)',      'pages::article_detail/$1');

// ---------------------------------------------------------------
// Admin routes
// ---------------------------------------------------------------
$routes->get( 'administrator',              'Admin::index');
$routes->get( 'administrator/login',        'Admin::login');
$routes->post('administrator/login',        'Admin::login');
$routes->get( 'administrator/logout',       'Admin::logout');
$routes->get( 'administrator/register',     'Admin::register');
$routes->post('administrator/register',     'Admin::register');

// Protected admin routes (guarded by the 'adminauth' filter)
$routes->group('administrator', ['filter' => 'adminauth'], static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin::dashboard');

    // Articles
    $routes->get( 'articles',               'Admin::articles');
    $routes->get( 'articles/new',           'Admin::articleForm');
    $routes->get( 'articles/edit/(:num)',   'Admin::articleForm/$1');
    $routes->post('articles/save',          'Admin::articleSave');
    $routes->post('articles/delete/(:num)', 'Admin::articleDelete/$1');
    $routes->get( 'articles/export',        'Admin::exportXml');

    // Gallery
    $routes->get( 'gallery',               'Admin::gallery');
    $routes->get( 'gallery/new',           'Admin::galleryForm');
    $routes->get( 'gallery/edit/(:num)',   'Admin::galleryForm/$1');
    $routes->post('gallery/save',          'Admin::gallerySave');
    $routes->post('gallery/delete/(:num)', 'Admin::galleryDelete/$1');

    // Messages
    $routes->get('messages',       'Admin::messages');
    $routes->get('messages/(:num)', 'Admin::message/$1');
});

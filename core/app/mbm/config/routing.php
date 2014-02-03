<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 *
 * *                    - yu ch bj bolno
 * [i]                  - buhel too bna
 * [i:id]               - 'id' huvisagchid hargalzah buhel too bna
 * [a:action]           - 'action' huvisagchid hargalzah alphanumaric bna
 * [h:key]              - 'key' character buhii hexadecimal
 * [:action]            - / iin ard buig esvel URI iin hamgiin tugsguliig  'action' gej avna
 * [create|edit:action] - Match either 'create' or 'edit' as 'action'
 * [*]                  - Catch all (lazy)
 * [*:trailing]         - Catch all as 'trailing' (lazy)
 * [**:trailing]        - Catch all (possessive - will match the rest of the URI)
 * .[:format]?          - 'format' - a / or . duriin format. optional
 * /?                   - / -r tugsuj bolno tugsuhgui bsan ch bolno
 */
set_route('home_page', '/');
set_route('homepage', '/');
set_route('home', '/');

/**
 * Route tohiruulj bna. suuld haa negteei shuud get_route('admin_home') gej ashiglaj link zaaj bolno.
 */
set_route('admin_home', '/admin');

$router->respond('GET', '/', function ($request, $response, $service, $app) use($router) {
    set_application(APP_ENABLED);
    set_module(DEFAULT_MODULE);
    set_action(DEFAULT_ACTION);
});

$router->respond('GET', '/test.php', function ($request, $response, $service, $app) use($router) {
    set_application(APP_ENABLED);
    set_module(DEFAULT_MODULE);
    set_action(DEFAULT_ACTION);
});


//default module/action route
// odoogoot zuvhun /m/module/ buyu slash aar tugssun utgiig avch bgaa
$router->with('/m', function () use ($router) {

    $router->respond('/[:module]/.[:action]?[.*]?', function($request, $response, $service, $app) use($router) {
        set_module($request->module);
        if (!$request->action) {
            set_action('index');
            set_get_parameter('action', 'index');
        } else {
            set_action($request->action);
            set_get_parameter('action', $request->action);
        }
        set_get_parameter('module', $request->module);
    });
});

//admin gej ehleegui buh huudsuud
$router->respond('!@^/admin', function() {
    set_layout(DEFAULT_LAYOUT);
});

//flatroom
$router->respond('@^/flatroom', function() {
    \M\Config::set('is_admin', 0);
    set_layout('flatroom');
    set_module('home');
    set_action('index');
});

//admin gej ehlesen tohioldold buh huudsuud
$router->respond('@^/admin', function($request, $response, $service, $app) {
    $response->noCache();
    set_layout('admin');
});

//admin ii route
$router->with('/admin', function () use ($router) {
    \M\Config::set('is_admin', 1);

    //admin home
    $router->respond('GET', '/?', function ($request, $response) {
        set_module('admin');
        set_action('index');
    });
});

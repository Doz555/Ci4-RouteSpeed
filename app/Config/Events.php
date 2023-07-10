<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use App\Controllers\Home;
/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

$ipAddress = $_SERVER['REMOTE_ADDR'];
$requestUri = '';
Events::on('post_controller_constructor', function () use (&$start, &$requestUri) {
    $startTime = microtime(true);
    $start = $startTime;
    $requestUri = service('request')->uri->getPath();
});

Events::on('post_system', function () use (&$start, &$requestUri, &$ipAddress) {
    $endTime = microtime(true);
    $executionTime = $endTime - $start;
    $executionTimeFormatted = number_format($executionTime, 3);
    (new Home())->Log_insert(json_encode([
        'route' => (explode('/', $requestUri)[0] == "") ? 'Home' : explode('/', $requestUri)[0],
        'name' => $requestUri,
        'time' => $executionTimeFormatted,
        'ip' => '' . ($ipAddress ? $ipAddress : '0.0.0.0'),
    ]));
});

Events::on('pre_system', static function () {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn ($buffer) => $buffer);
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     */
    if (CI_DEBUG && !is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        Services::toolbar()->respond();
    }
});

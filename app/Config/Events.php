<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;

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

//Eventos do AuthPackge
Events::on(\Fluent\Auth\Contracts\VerifyEmailInterface::class, function ($email) {
    (new \App\Notifications\VerificationNotification($email))->send();
});

Events::on(\Fluent\Auth\Contracts\ResetPasswordInterface::class, function ($email, $token) {
    (new \App\Notifications\ResetPasswordNotification($email, $token))->send();
});

//Meus eventos 
Events::on('notify_manager', function ($email) {
    (new \App\Notifications\ManagerNotification($email))->send();
});

Events::on('notify_user_advert', function ($email, $message) {
    (new \App\Notifications\UserAdvertNotification($email, $message))->send();
});

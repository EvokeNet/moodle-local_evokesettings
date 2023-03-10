<?php

/**
 * Evoke events observers
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname' => '\core\event\user_loggedin',
        'callback' => '\local_evokesettings\observers\redirect::observer',
        'internal' => false
    ],
    [
        'eventname' => '\core\event\dashboard_viewed',
        'callback' => '\local_evokesettings\observers\redirect::observer',
        'internal' => false
    ],
    [
        'eventname' => '\core\event\course_viewed',
        'callback' => '\local_evokesettings\observers\redirect::observer',
        'internal' => false
    ],
    [
        'eventname' => '\core\event\user_loggedout',
        'callback' => '\local_evokesettings\observers\redirect::observer',
        'internal' => false
    ],
];

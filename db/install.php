<?php

/**
 * Installation script
 *
 * @package     mod_evokeportfolio
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
defined('MOODLE_INTERNAL') || die();


/**
 * Code run after the local_evokesettings module database tables have been created.
 *
 * Loads old evoke game settings.
 *
 * @return bool
 */
function xmldb_local_evokesettings_install() {
    $settings = get_config('local_evokegame');

    if (!$settings) {
        return true;
    }

    foreach ($settings as $key => $setting) {
        if ((substr($key, 0, 16) == 'coursemenuitems-') && !empty(trim($setting))) {
            set_config($key, $setting, 'local_evokesettings');
        }
    }

    return true;
}



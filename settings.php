<?php

/**
 * This adds the Evoke Settings page.
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('root', new admin_category('evoke_core', 'Evoke'));
$ADMIN->add('evoke_core', new admin_externalpage('evoke_evokesettings', get_string('pages', 'local_evokesettings'),
    new moodle_url('/local/evokesettings/pages.php')));

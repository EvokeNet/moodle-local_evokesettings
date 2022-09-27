<?php

/**
 * Library of interface functions and constants.
 *
 * @package     local_marketplace
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die();

function local_evokesettings_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('moodle/course:update', $context)) {
        $url = new moodle_url('/local/evokesettings/coursesettings.php', array('id' => $course->id));

        $navigation->add(
            get_string('coursesettings', 'local_evokesettings'),
            $url,
            navigation_node::TYPE_CUSTOM,
            null,
            'coursesettings',
            new pix_icon('i/course', '')
        );
    }
}

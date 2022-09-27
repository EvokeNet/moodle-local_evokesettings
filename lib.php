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
            'evokesettingscoursesettings',
            new pix_icon('i/course', '')
        );
    }
}

/**
 *
 * Extend navigation to show the pages in the navigation block
 *
 * @param global_navigation $nav
 */
function local_evokesettings_extend_navigation(global_navigation $nav) {
    global $PAGE, $DB;

    $pages = $DB->get_records('evokesettings_pages', ['showonmenu' => 1]);

    if (!$pages) {
        return true;
    }

    if ($home = $nav->find('home', global_navigation::TYPE_SETTING)) {
        $home->remove();
    }

    foreach ($pages as $page) {
        $url = new moodle_url( '/local/evokesettings/page.php', ['id' => $page->slug]);

        $PAGE->navigation->add(
            $page->title,
            $url,
            navigation_node::TYPE_CONTAINER
        );

        $nav->add(
            $page->title,
            $url,
            navigation_node::TYPE_ROOTNODE,
            $page->title,
            $page->slug
        );
    }
}

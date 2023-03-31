<?php

/**
 * Event listener for dispatched event
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace local_evokesettings\observers;

defined('MOODLE_INTERNAL') || die;

use core\event\base as baseevent;

class redirect {
    public static function observer(baseevent $event) {
        global $USER, $CFG, $DB;

        if (is_siteadmin()) {
            return;
        }

        if ($event instanceof \core\event\course_viewed) {
            $data = $event->get_data();

            if ($data['courseid'] == 1) {
                $courses = enrol_get_all_users_courses($USER->id);

                if (empty($courses) || count($courses) > 1) {
                    return;
                }

                $course = current($courses);

                redirect(new \moodle_url('/course/view.php', ['id' => $course->id]));
            }
        }

        if ($event instanceof \core\event\user_loggedout) {
            $user = $DB->get_record('user', ['id' => $event->userid]);

            if ($user->auth == 'oauth2') {
                $issuer = $DB->get_record_sql("SELECT * FROM {oauth2_issuer} WHERE baseurl like '%evokenet%'");

                if (!$issuer) {
                    return;
                }

                $encodedredirecturi = urlencode($CFG->wwwroot);

                return redirect(new \moodle_url("{$issuer->baseurl}/protocol/openid-connect/logout?redirect_uri={$encodedredirecturi}"));
            }
        }
    }
}

<?php

/**
 * Configure course coursesettingss.
 *
 * @package     mod_evokeportfolio
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

require(__DIR__.'/../../config.php');

// Course module id.
$id = required_param('id', PARAM_INT);
$course = $DB->get_record('course', ['id' => $id], '*', MUST_EXIST);

require_course_login($course, true);

$context = context_course::instance($course->id);

$url = new moodle_url('/local/evokesettings/coursesettings.php', ['id' => $course->id]);

$PAGE->set_url($url);
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

$formdata = [
    'courseid' => $id
];

$form = new \local_evokesettings\forms\coursesettings($url, $formdata);

if ($form->is_cancelled()) {
    redirect(new moodle_url('/course/view.php', ['id' => $id]));
} else if ($formdata = $form->get_data()) {
    $data = clone $formdata;

    unset($data->submitbutton);

    $coursesettingsutil = new \local_evokesettings\util\coursesettings();

    $coursesettingsutil->process_form($data);

    $url = new moodle_url('/course/view.php', ['id' => $id]);
    redirect($url, get_string('coursesettings_success', 'local_evokesettings'), null, \core\output\notification::NOTIFY_SUCCESS);
} else {
    echo $OUTPUT->header();

    $renderer = $PAGE->get_renderer('local_evokesettings');

    $contentrenderable = new \local_evokesettings\output\coursesettings($course, $form);

    echo $renderer->render($contentrenderable);

    echo $OUTPUT->footer();
}
<?php

/**
 * Categories admin page.
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

require(__DIR__.'/../../config.php');

$action = optional_param('action', null, PARAM_ALPHANUMEXT);
$id = optional_param('id', null, PARAM_INT);

require_login();
$context = context_system::instance();
require_capability('moodle/site:config', $context);

$params = [];
if ($action) {
    $params['action'] = $action;
}

if ($id) {
    $params['id'] = $id;
}

$url = new moodle_url('/local/evokesettings/pages.php', $params);

$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title(get_string('pages', 'local_evokesettings'));
$PAGE->set_heading(get_string('pages', 'local_evokesettings'));

$renderer = $PAGE->get_renderer('local_evokesettings');

if (!$action) {
    $contentrenderable = new \local_evokesettings\output\pages($context);

    echo $OUTPUT->header();

    echo $renderer->render($contentrenderable);

    echo $OUTPUT->footer();

    exit;
}

$redirecturl = new moodle_url('/local/evokesettings/pages.php');

$pageentity = new \local_evokesettings\local\entities\page();

$dbpage = null;
if ($action == 'update' || $action == 'delete') {
    $dbpage = $DB->get_record('evokesettings_pages', ['id' => $id], '*', MUST_EXIST);
}

if ($action == 'delete') {
    try {
        if (!confirm_sesskey()) {
            redirect($redirecturl, get_string('invaliddata', 'error'), null, \core\output\notification::NOTIFY_ERROR);
        }

        $id = required_param('id', PARAM_INT);

        list($success, $message) = $pageentity->delete($id);

        if ($success) {
            redirect($redirecturl, $message, null, \core\output\notification::NOTIFY_SUCCESS);
        }

        redirect($redirecturl, $message, null, \core\output\notification::NOTIFY_ERROR);

    } catch (\Exception $e) {
        redirect($redirecturl, get_string('invaliddata', 'error'), null, \core\output\notification::NOTIFY_ERROR);
    }
}

$form = new \local_evokesettings\forms\pages($url, $dbpage);

if ($form->is_cancelled()) {
    redirect($redirecturl);
}

if ($formdata = $form->get_data()) {
    $page = new \stdClass();
    $page->title = $formdata->title;
    $page->slug = $formdata->slug;
    $page->showonmenu = $formdata->showonmenu;
    $page->content = $formdata->content['text'];
    $page->timemodified = time();

    $redirecturl = new moodle_url('/local/evokesettings/pages.php');

    $success = false;
    $message = '';
    if ($action == 'create') {
        $page->timecreated = time();

        list($success, $message) = $pageentity->create($page);
    }

    if ($action == 'update') {
        $page->id = $id;

        list($success, $message) = $pageentity->update($page);
    }

    if ($success) {
        redirect($redirecturl, $message, null, \core\output\notification::NOTIFY_SUCCESS);
    }

    redirect($redirecturl, $message, null, \core\output\notification::NOTIFY_ERROR);
}

echo $OUTPUT->header();

$form->display();

echo $OUTPUT->footer();

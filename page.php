<?php

/**
 * Categories admin page.
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

require(__DIR__.'/../../config.php');

$id = optional_param('id', null, PARAM_ALPHANUMEXT);

$page = $DB->get_record('evokesettings_pages', ['slug' => $id], '*', MUST_EXIST);

$context = context_system::instance();

$params['id'] = $id;

$url = new moodle_url('/local/evokesettings/page.php', $params);

$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($page->title);
$PAGE->set_heading($page->title);

$renderer = $PAGE->get_renderer('local_evokesettings');

$contentrenderable = new \local_evokesettings\output\page($page);

echo $OUTPUT->header();

echo $renderer->render($contentrenderable);

echo $OUTPUT->footer();

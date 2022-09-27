<?php

namespace local_evokesettings\forms;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * Categories form.
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class pages extends \moodleform {
    /**
     * The form definition.
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'title', get_string('page_title', 'local_evokesettings'));
        $mform->addRule('title', get_string('required'), 'required', null, 'client');
        $mform->addRule('title', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->setType('title', PARAM_TEXT);
        if (isset($this->_customdata->title)) {
            $mform->setDefault('title', $this->_customdata->title);
        }

        $mform->addElement('text', 'slug', get_string('page_slug', 'local_evokesettings'));
        $mform->addRule('slug', get_string('required'), 'required', null, 'client');
        $mform->addRule('slug', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->setType('slug', PARAM_TEXT);
        if (isset($this->_customdata->slug)) {
            $mform->setDefault('slug', $this->_customdata->slug);
        }

        $yesnooptions = [0 => get_string('no'), 1 => get_string('yes')];

        $mform->addElement('select', 'showonmenu', get_string('page_showonmenu', 'local_evokesettings'), $yesnooptions);
        $mform->addRule('showonmenu', get_string('required'), 'required', null, 'client');
        $mform->setType('showonmenu', PARAM_INT);
        if (isset($this->_customdata->showonmenu)) {
            $mform->setDefault('showonmenu', $this->_customdata->showonmenu);
        } else {
            $mform->setDefault('showonmenu', 1);
        }

        $mform->addElement('editor', 'content', get_string('page_content', 'local_evokesettings'), $yesnooptions);
        $mform->addRule('content', get_string('required'), 'required', null, 'client');
        $mform->setType('content', PARAM_RAW);
        if (isset($this->_customdata->content)) {
            $mform->setDefault('content', ['text' => $this->_customdata->content, 'format' => 1]);
        }

        $this->add_action_buttons(true);
    }

    /**
     * A bit of custom validation for this form
     *
     * @param array $data An assoc array of field=>value
     * @param array $files An array of files
     *
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        $title = isset($data['title']) ? $data['title'] : null;
        $slug = isset($data['slug']) ? $data['slug'] : null;
        $content = isset($data['content']['text']) ? $data['content']['text'] : null;

        if ($this->is_submitted() && (empty($title) || strlen($title) < 3)) {
            $errors['title'] = get_string('validation:minlen', 'local_evokesettings', 3);
        }

        if ($this->is_submitted() && (empty($slug) || strlen($slug) < 3)) {
            $errors['slug'] = get_string('validation:minlen', 'local_evokesettings', 3);
        }

        if ($this->is_submitted() && (empty($content) || strlen($content) < 10)) {
            $errors['content'] = get_string('validation:minlen', 'local_evokesettings', 10);
        }

        return $errors;
    }
}
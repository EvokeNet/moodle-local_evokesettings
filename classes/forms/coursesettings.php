<?php

namespace local_evokesettings\forms;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir. '/formslib.php');

class coursesettings extends \moodleform {
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('textarea', 'coursemenuitems', get_string('coursemenuitems', 'local_evokesettings'), 'wrap="virtual" rows="10" cols="100"');
        $mform->setType('coursemenuitems', PARAM_RAW);
        $mform->addHelpButton('coursemenuitems','coursemenuitems',  'local_evokesettings');

        $this->fill_field_with_database_value('coursemenuitems');

        $mform->addElement('html', '<div class="row"><div class="col-md-3"></div><div class="col-md-9">'.get_string('coursemenuitems_help', 'local_evokesettings').'</div></div>');

        $this->add_action_buttons(true);
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        return $errors;
    }

    private function fill_field_with_database_value($fieldname) {
        $fielddbname = $fieldname . '-' . $this->_customdata['courseid'];

        $fieldvalue = get_config('local_evokesettings', $fielddbname);

        if ($fieldvalue === false) {
            return false;
        }

        $mform = $this->_form;

        $mform->setDefault($fieldname, $fieldvalue);
    }
}
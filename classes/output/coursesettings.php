<?php

namespace local_evokesettings\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;

/**
 * Ranking renderable class.
 *
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class coursesettings implements renderable, templatable {
    protected $course;
    protected $form;

    public function __construct($course, $form) {
        $this->course = $course;
        $this->form = $form;
    }

    public function export_for_template(renderer_base $output) {

        return [
            'courseid' => $this->course->id,
            'courusename' => $this->course->fullname,
            'form' => $this->form->render()
        ];
    }
}

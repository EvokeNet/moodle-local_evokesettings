<?php

namespace local_evokesettings\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use local_evokesettings\local\entities\page;

/**
 * Marketplace renderable class.
 *
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class pages implements renderable, templatable {
    protected $context;

    public function __construct($context) {
        $this->context = $context;
    }

    public function export_for_template(renderer_base $output) {
        $pageentity = new page();

        return [
            'pages' => $pageentity->get_all()
        ];
    }
}

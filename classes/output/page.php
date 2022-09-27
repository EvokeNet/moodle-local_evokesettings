<?php

namespace local_evokesettings\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;

/**
 * Marketplace renderable class.
 *
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class page implements renderable, templatable {
    protected $page;

    public function __construct($page) {
        $this->page = $page;
    }

    public function export_for_template(renderer_base $output) {
        return [
            'pagecontent' => format_text($this->page->content, FORMAT_HTML, ['noclean' => true, 'trusted' => true])
        ];
    }
}

<?php

/**
 * Evoke game main renderer
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace local_evokesettings\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;
use renderable;

class renderer extends plugin_renderer_base {
    public function render_coursesettings(renderable $page) {
        $data = $page->export_for_template($this);

        return parent::render_from_template('local_evokesettings/coursesettings', $data);
    }
}
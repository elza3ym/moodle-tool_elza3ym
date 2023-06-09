<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Index Page Renderer And Template.
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_elza3ym\output;

use renderer_base;

/**
 * index_page that implements the templating and rendering Interfaces.
 */
class index_page implements \renderable, \templatable {

    /**
     * @var array $tasks
     */
    private $tasks;

    /**
     * Initialize data to pass to view.
     * @param array $tasks
     */
    public function __construct(array $tasks) {
        $this->tasks = $tasks;
    }

    /**
     * Prepare data for templating.
     * @param renderer_base $output
     * @return \stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new \stdClass();
        $data->tasks = $this->tasks;
        $data->sesskey = sesskey();
        $data->pluginbaseurl = (new \moodle_url('/admin/tool/elza3ym'))->out(true);

        return $data;
    }
}

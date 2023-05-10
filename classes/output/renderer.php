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
 * Plugin Renderer.
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_elza3ym\output;

/**
 * Plugin Renderer is responsible for rendering the templates and passing values.
 */
class renderer extends \plugin_renderer_base {
    /**
     * Render index_page template
     * @param index_page $page
     * @return bool|string
     * @throws \moodle_exception
     */
    public function render_index_page(index_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('tool_elza3ym/index_page', $data);
    }

    /**
     * Render view_page template
     * @param view_page $page
     * @return bool|string
     * @throws \moodle_exception
     */
    public function render_view_page(view_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('tool_elza3ym/view_page', $data);
    }
}

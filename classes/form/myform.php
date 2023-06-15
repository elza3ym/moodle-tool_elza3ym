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
 * Task Form.
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_elza3ym\form;

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/formslib.php");

/**
 * Task creation/Edit Form.
 */
class myform extends \moodleform {

    /**
     * define our form structure.
     * @return void
     * @throws \coding_exception
     */
    protected function definition() {
        $mform = $this->_form;

        // Add name text input.
        $mform->addElement('text', 'tasktitle', 'Task Title', ['placeholder' => 'Please enter task title']);
        $mform->setType('tasktitle', PARAM_NOTAGS);

        // Add completed checkbox.
        $mform->addElement('checkbox', 'completed', get_string('completed', 'tool_elza3ym'));

        // Add hidden field for courseid.
        $mform->addElement('hidden', 'courseid', $this->_customdata['courseid'] ?? 1);
        $mform->setType('courseid', PARAM_INT);

        // Form submittion buttons.
        $this->add_action_buttons();

    }
}

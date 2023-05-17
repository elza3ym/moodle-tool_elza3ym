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
 * Handle Task Editing.
 *
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once("$CFG->libdir/adminlib.php");

$pagetitle = get_string('edittask', 'tool_elza3ym');
$moodleurl = new moodle_url('/admin/tool/elza3ym/edit.php');
$courseid = optional_param('id', 0, PARAM_INT);
$task = $DB->get_record('tool_elza3ym', ['id' => $courseid]);
require_login();
// Check Capability.
require_capability('tool/elza3ym:edit', context_system::instance());

// PAGE.
$PAGE->set_context(context_system::instance());
$PAGE->set_url($moodleurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);


// Render Page.
$output = $PAGE->get_renderer('tool_elza3ym');

echo $output->header();
echo $output->heading($pagetitle);

// Form Handling.
$customdata = [
    'courseid' => $courseid
];

$taskurl = new moodle_url('/admin/tool/elza3ym/edit.php', ['id' => $courseid]);
$tasksurl = new moodle_url('/admin/tool/elza3ym/index.php');
$mform = new \tool_elza3ym\form\myform($taskurl, $customdata);
if ($mform->is_cancelled()) {
    // If form is cancelled.
    redirect($tasksurl, 'Task Updated Successfully.');
} else if ($data = $mform->get_data()) {
    $task->name = $data->name;
    $task->completed = $data->completed ?? 0;
    $DB->update_record('tool_elza3ym', $task);
    redirect($tasksurl, 'Task Updated Successfully.');
} else {
    $mform->set_data([
        'name' => $task->name,
        'completed' => $task->completed
    ]);
    echo html_writer::start_div('card mt-4');
    echo html_writer::start_div('card-header');
    echo html_writer::span(get_string('singletaskedit', 'tool_elza3ym', $task->id), 'h6');
    echo html_writer::end_div();
    echo html_writer::start_div('card-body');
    $mform->display();
    echo html_writer::end_div();
    echo html_writer::end_div();
}

echo $output->footer();

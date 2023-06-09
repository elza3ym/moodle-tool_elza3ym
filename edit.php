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

// Check Capability.
require_login();
require_capability('tool/elza3ym:edit', context_system::instance());

$task = \tool_elza3ym\task::get($courseid);

// PAGE.
$PAGE->set_context(context_system::instance());
$PAGE->set_url($moodleurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);

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

    $task->completed = $data->completed ?? 0;
    $task->tasktitle = $data->tasktitle;


    $isedited = $task->save();
    if ($isedited) {
        redirect($tasksurl, 'Task Updated Successfully.');
    } else {
        echo html_writer::div('Something went wrong!', 'alert alert-danger');
    }
}

// Render Page.
$output = $PAGE->get_renderer('tool_elza3ym');

echo $output->header();
echo $output->heading($pagetitle);


$mform->set_data([
    'tasktitle' => $task->tasktitle,
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


echo $output->footer();

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
 * Main Index File Displays Tasks List.
 *
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
$systemcontext = context_system::instance();

if ($deleteid = optional_param('delete', null, PARAM_INT)) {
    require_sesskey();
    $task = $DB->get_record('tool_elza3ym', ['id' => $deleteid], '*', MUST_EXIST);
    require_login(get_course($task->courseid));
    require_capability('tool/elza3ym:edit', context_course::instance($task->courseid));
    $DB->delete_records('tool_elza3ym', ['id' => $deleteid]);
    redirect(new moodle_url('/admin/tool/elza3ym/index.php', ['id' => $task->courseid]));
}

require_capability('tool/elza3ym:view', $systemcontext);
$pagetitle = 'Hello to the todo list';
$url = new moodle_url('/admin/tool/elza3ym/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($pagetitle);
$PAGE->set_heading(get_string('pluginname', 'tool_elza3ym'));

$output = $PAGE->get_renderer('tool_elza3ym');

echo $output->header();
echo $output->heading($pagetitle);




$courseid = optional_param('courseid', 1, PARAM_INT);
$tasks = $DB->get_records('tool_elza3ym', null, 'id DESC', '*');

$renderable = new \tool_elza3ym\output\index_page(array_values($tasks));



echo $output->render($renderable);

$mform = new \tool_elza3ym\form\myform();
if ($mform->is_submitted()) {
    $data = $mform->get_data();
    $task = new stdClass();
    $task->name = $data->name;
    $task->completed = $data->completed ?? 0;
    $task->courseid = $data->courseid;

    $insertedtaskid = $DB->insert_record('tool_elza3ym', $task, true);


    if ($insertedtaskid) {
        $tasksurl = new moodle_url('/admin/tool/elza3ym/index.php');
        redirect($tasksurl, 'Task Created Successfully.');
    } else {
        echo html_writer::div('Something went wrong!', 'alert alert-danger');
    }
} else if ($mform->is_cancelled()) {
    // TODO: the content of is_cancelled Creation.
    return false;
} else {
    echo html_writer::start_div('card mt-4');
    echo html_writer::start_div('card-header');
    echo html_writer::span('Create New Task', 'h6');
    echo html_writer::end_div();
    echo html_writer::start_div('card-body');
    $mform->display();
    echo html_writer::end_div();
    echo html_writer::end_div();

}

echo $output->footer();

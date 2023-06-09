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
    $task = \tool_elza3ym\task::get($deleteid);
    require_sesskey();
    require_login(get_course($task->courseid));
    require_capability('tool/elza3ym:edit', context_course::instance($task->courseid));

    $isdeleted = $task->remove();

    if ($isdeleted) {
        redirect(new moodle_url('/admin/tool/elza3ym/index.php', ['id' => $task->courseid]), 'Task Deleted Successfully.');
    } else {
        echo html_writer::div('Something went wrong!', 'alert alert-danger');
    }
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

$mform = new \tool_elza3ym\form\myform();
if ($mform->is_submitted()) {
    $data = $mform->get_data();
    $task = new \tool_elza3ym\task();
    $task->tasktitle = $data->tasktitle;
    $task->completed = $data->tasktitle ?? 0;

    if ($task->save()) {
        $tasksurl = new moodle_url('/admin/tool/elza3ym/index.php');
        redirect($tasksurl, 'Task Created Successfully.');
    } else {
        echo html_writer::div('Something went wrong!', 'alert alert-danger');
    }
}



echo $output->header();
echo $output->heading($pagetitle);




$courseid = optional_param('courseid', 1, PARAM_INT);
$tasks = \tool_elza3ym\task::getall();

$renderable = new \tool_elza3ym\output\index_page(array_values($tasks));

echo $output->render($renderable);
    echo html_writer::start_div('card mt-4');
    echo html_writer::start_div('card-header');
    echo html_writer::span('Create New Task', 'h6');
    echo html_writer::end_div();
    echo html_writer::start_div('card-body');
    $mform->display();
    echo html_writer::end_div();
    echo html_writer::end_div();


echo $output->footer();

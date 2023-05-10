<?php
require_once(__DIR__.'/../../../config.php');
require_once("$CFG->libdir/adminlib.php");

$page_title = get_string('edit_task', 'tool_elza3ym');
$moodle_url = new moodle_url('/admin/tool/elza3ym/edit.php');
$course_id = optional_param('id', 0, PARAM_INT);
$task = $DB->get_record('tool_elza3ym', ['id' => $course_id]);
require_login();
// Check Capability.
if (!has_capability('tool/elza3ym:edit', context_system::instance())) {
  die;
}

// $PAGE
$PAGE->set_context(context_system::instance());
$PAGE->set_url($moodle_url);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($page_title);
$PAGE->set_heading($page_title);


// Render Page
$output = $PAGE->get_renderer('tool_elza3ym');

echo $output->header();
echo $output->heading($page_title);

// Form Handling.
$custom_data = [
  'courseid' => $course_id
];

$task_url = new moodle_url('/admin/tool/elza3ym/edit.php?id='.$course_id);
$mform = new \tool_elza3ym\form\myform($task_url, $custom_data);
if ($mform->is_cancelled()) {
  // if form is cancelled.
} else if ($data = $mform->get_data()) {
    $task->name = $data->name;
    $task->completed = $data->completed ?? 0;
    $DB->update_record('tool_elza3ym', $task);
    redirect($task_url, 'Task Updated Successfully.');
} else {
  $mform->set_data([
    'name' => $task->name,
    'completed' => $task->completed
  ]);
  echo html_writer::start_div('card mt-4');
  echo html_writer::start_div('card-header');
  echo html_writer::span(get_string('single_task_edit', 'tool_elza3ym', $task->id), 'h6');
  echo html_writer::end_div();
  echo html_writer::start_div('card-body');
  $mform->display();
  echo html_writer::end_div();
  echo html_writer::end_div();
}

echo $output->footer();
<?php
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

//admin_externalpage_setup('toolelza3ym');

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

$renderable = new \tool_elza3ym\output\index_page();
$systemcontext = context_system::instance();

if (!has_capability('tool/elza3ym:view', $systemcontext)) {
  die;
}

$course_id = optional_param('courseid', 0, PARAM_INT);

echo $output->render($renderable);

$tasks = $DB->get_records('tool_elza3ym', null, 'id DESC', '*');
if (!empty($tasks)) {
  foreach ($tasks as $task) {
    echo html_writer::start_div('card mt-4');
    echo html_writer::start_div('card-header');
    echo html_writer::link(new moodle_url('/admin/tool/elza3ym/edit.php?id='.$task->id), get_string('single_task', 'tool_elza3ym', $task->id));
    echo html_writer::end_div();
    echo html_writer::start_div('card-body');
    echo html_writer::span($task->name, 'h6');
    echo html_writer::start_div('float-right');
    if ($task->completed) {
      echo html_writer::span('Completed', 'h6 mr-3');
      echo html_writer::tag('i', '', ['class' => 'fa fa-check icon text-success']);
    } else {
      echo html_writer::span('Not Completed', 'h6 mr-3');
      echo html_writer::tag('i', '', ['class' => 'fa fa-x icon text-danger']);
    }
    echo html_writer::end_div();
    echo html_writer::end_div();
    echo html_writer::end_div();
  }
}

$mform = new \tool_elza3ym\form\myform();
if ($mform->is_submitted()) {
  $data = $mform->get_data();

  $inserted_task = $DB->get_records('tool_elza3ym', null, 'id DESC', '*',  0, 1);
  if ($inserted_task && !empty($inserted_task)) {
    echo html_writer::link(new moodle_url('/admin/tool/elza3ym/edit.php?id='.$inserted_task[0]->id), get_string('edit_single_task', 'tool_elza3ym', $inserted_task[0]->id));
  } else {
    echo html_writer::div('Something went wrong!', 'alert alert-danger');
  }
} else if ($mform->is_cancelled()) {
  // TODO: the content of is_cancelled Creation.
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
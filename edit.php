<?php
require_once(__DIR__.'/../../../config.php');
require_once("$CFG->libdir/adminlib.php");

$page_title = get_string('edit_task', 'tool_elza3ym');
$moodle_url = new moodle_url('/admin/tool/elza3ym/edit.php');
$course_id = required_param('courseid', PARAM_INT);

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

$mform = new \tool_elza3ym\form\myform(null, $custom_data);
if ($mform->is_cancelled()) {
  // if form is cancelled.
} else if ($mform->is_submitted()) {

} else {
  $mform->display();
}

echo $output->footer();
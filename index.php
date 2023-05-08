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

$renderable = new \tool_elza3ym\output\index_page('Some text');
$systemcontext = context_system::instance();

if (!has_capability('tool/elza3ym:view', $systemcontext)) {
  die;
}

$course_id = required_param('courseid', PARAM_INT);

echo $output->render($renderable);

echo html_writer::link(new moodle_url('/admin/tool/elza3ym/edit.php?courseid='.$course_id), get_string('edit_single_task', 'tool_elza3ym', $course_id));

echo $output->footer();
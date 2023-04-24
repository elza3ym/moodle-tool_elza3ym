<?php
require_once(__DIR__.'/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
$out = '';
$out .= html_writer::div('From view.php file', 'title', ['id' => 'titlehead']);
$out .= '      <span lang="ar" class="multilang">your_content_here</span>
      <span lang="en" class="multilang">your_content_in_other_language_here</span>';
$pagetitle = 'Text from view';
$course_id = optional_param('id',0, PARAM_INT);
$moodleUrl = new moodle_url('/tool/elza3ym/view.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title($pagetitle);
$PAGE->set_url($moodleUrl);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('pluginname', 'tool_elza3ym'));

// Breadcrumbs
$settingnode = $PAGE->settingsnav->add('setting', new moodle_url('/a/link/if/you/want/one.php'), navigation_node::TYPE_CONTAINER);
$thingnode = $settingnode->add('Name of thing', new moodle_url('/a/link/if/you/want/one.php'));
$thingnode->make_active();


$output = $PAGE->get_renderer('tool_elza3ym');

echo $output->header();
echo $output->heading($pagetitle);

$renderable = new \tool_elza3ym\output\view_page($pagetitle);
echo $output->render($renderable);
echo get_string('details', 'tool_elza3ym', $course_id);
//$userinput = 'no <b>tags</b> allowed in strings';
// $userinput = '<span class="multilang" lang="en">RIGHT</span><span class="multilang" lang="fr">WRONG</span>';
// $userinput = 'a" onmouseover=”alert(\'XSS\')" asdf="';
// $userinput = "3>2";
 $userinput = "2<3"; // Interesting effect, huh?

echo html_writer::div(s($userinput)); // Used when you want to escape the value.
echo html_writer::div(format_string($userinput)); // Used for one-line strings, such as forum post subject.
echo html_writer::div(format_text($userinput)); // Used for multil-line rich-text contents such as forum post body.


echo $output->footer();

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
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(__DIR__.'/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
$id = optional_param('id', 1, PARAM_INT);
require_login($id, false);
$out = '';
$out .= html_writer::div('From view.php file', 'title', ['id' => 'titlehead']);
$out .= '      <span lang="ar" class="multilang">your_content_here</span>
      <span lang="en" class="multilang">your_content_in_other_language_here</span>';
$pagetitle = 'Text from view';
$course_id = optional_param('id',0, PARAM_TEXT);
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

// DB Queries Testing.
//$DB->set_debug(true);

//$user = $DB->get_record('user', ['id' => $course_id], 'auth, email');
//$user = $DB->get_record_sql('SELECT * FROM {user} WHERE id = ?', [$course_id]);
//$user = $DB->get_field('user', 'auth', ['id' => $course_id]);
//$user = $DB->get_fieldset_select('user', 'auth', 'id = ?', [$course_id]);
$users = $DB->get_recordset('user');
while ($users->valid() && $user = $users->current()) {
  var_dump($user->email);
  $users->next();
}
//var_dump($user);

$systemcontext = context_system::instance();

if (!has_capability('tool/elza3ym:edit', $systemcontext)) {
  die;
}

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



// Form API
$mform = new \tool_elza3ym\form\myform();

if ($mform->is_cancelled()) {
  // When cancelled
} else if ($fromform = $mform->get_data()) {
  // when submitted
} else {
  // form is submitted and not valid. or not submitted I think
//  $mform->set_data($toform);

  $mform->display();

}

echo $output->footer();

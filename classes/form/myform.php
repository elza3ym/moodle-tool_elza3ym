<?php
namespace tool_elza3ym\form;


require_once("$CFG->libdir/formslib.php");

class myform extends \moodleform {

  protected function definition() {
    $mform = $this->_form;

    // Add name text input
    $mform->addElement('text', 'name', get_string('name'), ['placeholder' => 'Please enter your name']);
    $mform->setType('name', PARAM_NOTAGS);

    // Add completed checkbox
    $mform->addElement('checkbox', 'completed', get_string('completed', 'tool_elza3ym'));

    // Add hidden field for courseid.
    $mform->addElement('hidden', 'courseid', $this->_customdata['courseid'] ?? 0);
    $mform->setType('courseid', PARAM_INT);

    // Form submittion buttons.
    $this->add_action_buttons();

  }
}
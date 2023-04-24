<?php
defined('MOODLE_INTERNAL') || die;


$PAGE->navbar->ignore_active();
$PAGE->navbar->add('preview');
$PAGE->navbar->add('name of thing');



// Create folder / submenu in block menu, modsettings for activity modules, localplugins for Local plugins.
// The default folders are defined in admin/settings/plugins.php.
$ADMIN->add('blocksettings', new admin_category('blocksamplefolder',
  get_string('pluginname', 'tool_elza3ym')));

// Create settings block.
$settings = new admin_settingpage('Settings', 'settings');
if ($ADMIN->fulltree) {
  $settings->add(new admin_setting_configcheckbox('block_sample_checkbox', 'checkbox',
    'checkboxdescription', 0));
}

// This adds the settings link to the folder/submenu.
$ADMIN->add('blocksamplefolder', $settings);
// This adds a link to an external page.
$ADMIN->add('blocksamplefolder', new admin_externalpage('block_sample_page', 'externalpage',
  $CFG->wwwroot.'/blocks/sample/sample.php'));
// Prevent Moodle from adding settings block in standard location.
$settings = null;
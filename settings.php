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
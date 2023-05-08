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
 * This is some description to try to bypass the moodle cli action.
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$capabilities = [
  'tool/elza3ym:edit' => [
    'riskbitmask' => RISK_SPAM,
    'captype' => 'write',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => [
      'editingteacher' => CAP_ALLOW,
    ],
  ],
  'tool/elza3ym:view' => [
    'riskbitmask' => RISK_SPAM,
    'captype' => 'read',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => [
      'editingteacher' => CAP_ALLOW,
    ],
  ],
];


<?php
/**
 * functions for tasks crud.
 *
 * @package    tool_elza3ym
 * @copyright  2023 Mohamed Shehata
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function createtask($data) {
    global $DB;
    $task = new stdClass();
    $task->name = $data->name;
    $task->completed = $data->completed ?? 0;
    $task->courseid = $data->courseid;

    return $DB->insert_record('tool_elza3ym', $task, true);
}

function edittask($task, $data) {
    global $DB;
    $task->name = $data->name;
    $task->completed = $data->completed ?? 0;

    return $DB->update_record('tool_elza3ym', $task);
}
function deletetask($task) {
    global $DB;
    require_sesskey();
    require_login(get_course($task->courseid));
    require_capability('tool/elza3ym:edit', context_course::instance($task->courseid));
    return $DB->delete_records('tool_elza3ym', ['id' => $task->id]);
}

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
 * Handle task object.
 *
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_elza3ym;

/**
 * task class model.
 */
class task {
    /**
     * @var int|null $id
     */
    public ?int $id = null;

    /**
     * @var string $tasktitle
     */
    public string $tasktitle;

    /**
     * @var bool $completed
     */
    public bool $completed;

    /**
     * @var int|null $courseid
     */
    public ?int $courseid = 1;

    /**
     * Initialize instance of task stdclass.
     */
    public function __construct() {
    }

    /**
     * Get single task instance.
     * @param int $id
     * @return self|null
     */
    public static function get(int $id): ?self {
        global $DB;

        $instance = new self();
        $instance->id = $id;
        try {
            $task = $DB->get_record('tool_elza3ym', ['id' => $id], '*', MUST_EXIST);
        } catch (\Exception $exception) {
            return null;
        }
        $instance->id = $task->id;
        $instance->tasktitle = $task->tasktitle;
        $instance->completed = $task->completed;
        $instance->courseid = $task->courseid;
        return $instance;
    }

    /**
     * Get all tasks from the DB.
     * @return array
     * @throws \dml_exception
     */
    public static function getall(): array {
        global $DB;

        return $DB->get_records('tool_elza3ym', null, 'id DESC', '*');
    }


    /**
     * Persist the data edited/created and store them to DB.
     * @return int
     * @throws \dml_exception
     */
    public function save(): int {
        global $DB;

        if (!$this->id) {
            return $DB->insert_record('tool_elza3ym', $this, true);
        } else {
            $DB->update_record('tool_elza3ym', $this);
            return $this->id;
        }
    }

    /**
     * Remove task instance from DB.
     * @return bool
     * @throws \dml_exception
     */
    public function remove(): bool {
        global $DB;
        return $DB->delete_records('tool_elza3ym', ['id' => $this->id]);
    }
}

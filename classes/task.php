<?php
namespace tool_elza3ym;

class task {
    public ?int $id = null;
    public string $tasktitle;
    public bool $completed;
    public ?int $courseid = 1;

    public function __construct() {}

    public static function get(int $id): self {
        global $DB;

        $instance = new self();
        $instance->id = $id;
        $task = $DB->get_record('tool_elza3ym', ['id' => $id], '*', MUST_EXIST);
        $instance->id = $task->id;
        $instance->tasktitle = $task->tasktitle;
        $instance->completed = $task->completed;
        $instance->courseid = $task->courseid;
        return $instance;
    }

    public static function getAll():array {
        global $DB;

        return $DB->get_records('tool_elza3ym', null, 'id DESC', '*');
    }


    public function save():int {
        global $DB;

        if (!$this->id) {
            return $DB->insert_record('tool_elza3ym', $this, true);
        } else {
            $DB->update_record('tool_elza3ym', $this);
            return $this->id;
        }
    }

    public function remove():bool {
        global $DB;
        return $DB->delete_records('tool_elza3ym', ['id' => $this->id]);
    }
}
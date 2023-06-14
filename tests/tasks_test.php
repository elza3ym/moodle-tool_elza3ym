<?php
namespace tool_elza3ym;

require_once("$CFG->dirroot/$CFG->admin/tool/elza3ym/locallib.php");

class tasks_test extends \advanced_testcase {
    //TODO: create unit tests.
    //TODO: move index.php/edit.php concept to locallib.php file.
    public function test_task_create() {
        $data = new \stdClass();
        $data->name = 'Task1';
        $data->completed = 0;
        $taskId = createtask($data);
        $this->assertIsNumeric($taskId);

    }
}
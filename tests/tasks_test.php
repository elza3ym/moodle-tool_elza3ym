<?php
namespace tool_elza3ym;

//require_once("$CFG->dirroot/$CFG->admin/tool/elza3ym/locallib.php");

class tasks_test extends \advanced_testcase {
    //TODO: create unit tests.
    //TODO: move index.php/edit.php concept to locallib.php file.
    public function test_task_create() {
        $this->resetAfterTest(false);
        $task = new task();
        $task->tasktitle = 'title1';
        $task->completed = 0;
        $taskId = $task->save();
        $this->assertIsNumeric($taskId);

        // assert record in DB.
        $taskCheck = task::get($taskId);
        $this->assertInstanceOf(task::class, $taskCheck);
        $this->assertEquals($task->tasktitle, $taskCheck->tasktitle);
        $this->assertEquals($task->completed, $taskCheck->completed);

        return $taskCheck;
    }


    /**
     * @depends test_task_create
     */
    public function test_task_edit($task) {
        $this->resetAfterTest(false);
        $this->assertInstanceOf(task::class, $task);

        $task->tasktitle = 'edited task';
        $task->completed = 1;
        $taskId = $task->save();

        // assert updated record in DB.
        $taskCheck = task::get($taskId);
        $this->assertInstanceOf(task::class, $taskCheck);
        $this->assertEquals($task->tasktitle, $taskCheck->tasktitle);
        $this->assertEquals($task->completed, $taskCheck->completed);
        return $task;
    }

    /**
     * @depends test_task_create
     */
    public function test_task_delete(task $task) {
        $this->resetAfterTest(false);
        $task->remove();

        $taskCheck = task::get($task->id);
        $this->assertNull($taskCheck);
    }

}
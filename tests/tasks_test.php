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
 * Handle task crud tests.
 *
 * @covers     \tool_elza3ym
 * @package   tool_elza3ym
 * @copyright 2023, Mohamed Shehata <mohamed.shehata@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_elza3ym;

/**
 * task phpunit test cases.
 */
class tasks_test extends \advanced_testcase {
    /**
     * @return task
     * Test creating task.
     */
    public function test_task_create() {
        $this->resetAfterTest(false);
        $task = new task();
        $task->tasktitle = 'title1';
        $task->completed = 0;
        $taskid = $task->save();
        $this->assertIsNumeric($taskid);

        // Assert record in DB.
        $taskcheck = task::get($taskid);
        $this->assertInstanceOf(task::class, $taskcheck);
        $this->assertEquals($task->tasktitle, $taskcheck->tasktitle);
        $this->assertEquals($task->completed, $taskcheck->completed);

        return $taskcheck;
    }


    /**
     * Test editing task.
     *
     * @param task $task
     * @depends test_task_create
     */
    public function test_task_edit($task) {
        $this->resetAfterTest(false);
        $this->assertInstanceOf(task::class, $task);

        $task->tasktitle = 'edited task';
        $task->completed = 1;
        $taskid = $task->save();

        // Assert updated record in DB.
        $taskcheck = task::get($taskid);
        $this->assertInstanceOf(task::class, $taskcheck);
        $this->assertEquals($task->tasktitle, $taskcheck->tasktitle);
        $this->assertEquals($task->completed, $taskcheck->completed);
        return $task;
    }

    /**
     * Test deleting task.
     *
     * @param task $task
     * @depends test_task_create
     */
    public function test_task_delete(task $task) {
        $this->resetAfterTest(false);
        $task->remove();

        // Assert removed record from DB.
        $taskcheck = task::get($task->id);
        $this->assertNull($taskcheck);
    }

}

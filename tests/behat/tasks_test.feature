@javascript @tasks_test
Feature: CRUD task
  Background:
    When I log in as "admin"
    Given I navigate to "Plugins > Blocks > M.S first Moodle plugin" in site administration
    And I click on "Tasks Management" "link"
    Then I should see "Hello to the todo list"
    And I set the field "Name" to "Task1"
    And I click on "Completed ?" "checkbox"
    Then I press "Save changes"
    Then I should see "Task Created Successfully."
    And I wait to be redirected
    And I click on "Edit single task" "link"

  Scenario: Creating task
    When I log in as "admin"
    Given I navigate to "Plugins > Blocks > M.S first Moodle plugin" in site administration
    And I click on "Tasks Management" "link"
    Then I should see "Hello to the todo list"
    And I set the field "Name" to "Task2"
    And I click on "Completed ?" "checkbox"
    Then I press "Save changes"
    Then I should see "Task Created Successfully."

  Scenario: Editing task
    When I log in as "admin"
    Given I navigate to "Plugins > Blocks > M.S first Moodle plugin" in site administration
    And I click on "Tasks Management" "link"
    Then I should see "Hello to the todo list"
    And I click on "Edit single task" "link"
    And I set the field "Name" to "Task Edited"
    Then I press "Save changes"
    And I wait to be redirected
    Then I should see "Task Edited"

  Scenario: Deleting task
    When I log in as "admin"
    Given I navigate to "Plugins > Blocks > M.S first Moodle plugin" in site administration
    And I click on "Tasks Management" "link"
    Then I should see "Hello to the todo list"
    Then I should see "Task1"
    Then I click on "Delete Task" "link"
    And I wait to be redirected
    Then I should not see "Task1"
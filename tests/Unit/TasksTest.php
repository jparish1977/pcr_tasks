<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Task;
use App\User;

class TasksTest extends TestCase
{
    /**
     * Can create task.
     *
     * @return void
     */
    public function testCanCreateTask()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 3,
            'assignee' => 'Test Asignee',
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }
    
    /**
     * Test to ensure task description must be provided.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithoutDescription()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'priority' => 3,
            'assignee' => 'Test Asignee',
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('description')[0],"The Task Description field is required.");
    }
    
    /**
     * Test to ensure task priority must be provided.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithoutPriority()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'assignee' => 'Test Asignee',
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Priority field is required.", $errors->get('priority'));
    }
    
    /**
     * Test to ensure VALID task priority must be provided.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithoutValidPriority()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 'A',
            'assignee' => 'Test Asignee',
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Priority must be an integer.", $errors->get('priority'));
        
        $data['priority'] = 4;
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Priority must be between 0 and 3.", $errors->get('priority'));
    }
    
    /**
     * Test to ensure task assignee must be provided.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithoutAssignee()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 3,
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Assignee field is required.", $errors->get('assignee'));
    }
    
    /**
     * Test to ensure task assignee must be less than or equal to 100 characters.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithAssigneeGreaterThan100Characters()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 3,
            'assignee' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'due' => '2019-12-31',
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Assignee may not be greater than 100 characters.", $errors->get('assignee'));
    }
    
    /**
     * Test to ensure task due date must be provided.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithoutDueDate()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 3,
            'assignee' => 'Test Asignee'
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Due Date field is required.", $errors->get('due'));
    }
    
    /**
     * Test to ensure task due date must be valid.
     *
     * @return void
     */
    public function testCanNotCreateTaskWithInvalidDueDate()
    {
        $user = new User(['name' => 'Test User']);
        $user->id = 1;
        
        $this->be($user);
        
        $data = [
            'description' => 'Test task description',
            'priority' => 3,
            'assignee' => 'Test Asignee',
            'due' => 'bork'
        ];
        $response = $this->post(route('store_task'), $data);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertContains("The Task Due Date is not a valid date.", $errors->get('due'));
    }
}

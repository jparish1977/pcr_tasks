<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test that /tasks is available
     *
     * @return void
     */
    public function testTaskListIsAccessable()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }
    
   
    /**
     * Test that /tasks has the add task form when a user is present
     *
     * @return void
     */
    public function testSeeNewTaskForm()
    {
        $user = new User(['name' => 'Test User']);
        $this->be($user);
        $response = $this->get('/tasks');
        
        $response->assertSee('new-task-form');
    }
    
    /**
     * Test that /tasks does not have the add task form when a user is not present
     *
     * @return void
     */
    public function testDontSeeNewTaskForm()
    {
        $response = $this->get('/tasks');
        
        $response->assertDontSee('new-task-form');
    }
}

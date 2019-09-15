<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tasks' => Task::with('User')->get()
        ];

        return view('tasks', $data);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: Implement standalone page for creating a new task
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:200',
            'priority' => 'required|integer|between:0,3',
            'assignee' => 'required|max:100',
            'due' => 'required|date',
        ]);
        
        $dueDateValue = Carbon::parse($request->due);
        
        // There does not appear to be a built in validator for a multi column uniqueness constraint
        $exists = Task::where('description', $request->description)
                    ->where('assignee', $request->assignee)
                    ->where('due', $dueDateValue)
                    ->exists();

        if($exists){
            return redirect('/tasks')->withInput($request->input())
                    ->withErrors(['A task already exists with the specified description, assignee, and due date.']);
        }
        else{
            $task = new Task;
            $task->description = $request->description;
            $task->priority = (int) $request->priority;
            $task->assignee = $request->assignee;
            $task->due = $request->due;
            $task->status = Task::STATUS_PENDING;
            $task->user()->associate(Auth::user());

            $task->save();
            return redirect('/tasks')->with('success', 'Task created!');
        }
    }

    /**
     * Display the specified task.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // TODO: Implement standalone page for displayoing an individual task
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // TODO: Implement standalone page for editing an individual task
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|max:200',
            'priority' => 'required|integer|between:0,3',
            'due' => 'required|date',
            'status' => 'required|integer|between:0,2'
        ]);
        
        $dueDateValue = Carbon::parse($request->due);
        
        // There does not appear to be a built in validator for a multi column uniqueness constraint
        
        $existsQB = Task::where('description', $request->description)
                    ->where('assignee', $request->assignee)
                    ->where('due', $dueDateValue)
                    ->where('id','!=' , $task->id);
        
        $exists = $existsQB->exists();

        if($exists){
            return redirect('/tasks')->withInput($request->input())
                    ->withErrors(['A task already exists with the specified description, assignee, and due date.']);
        }
        else{
            $task->description = $request->description;
            $task->priority = (int) $request->priority;
            $task->due = $request->due;
            $task->status = $request->status;

            $task->save();
            return redirect('/tasks')->with('success', 'Task updated!');   
        }
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if(Auth::user()->id != $task->user->id){
            return redirect('/tasks')
                    ->withErrors(['A task can only be deleted by its owner.']);
        }
        else{
            $task->delete();
            return redirect('/tasks')->with('success', 'Task deleted!');
        }
    }
}

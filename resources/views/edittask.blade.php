<div class='edit_task_form'>
    <form action='/task/{{ $task->id }}' name='update-task-form_{{ $task->id }}' method='POST' class='form-horizontal' autocomplete='off'>
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            {{ csrf_field() }}
            <div class="col-sm-6">
                <div><label>Owner:</label> {{ $task->user->name }}</div>

                <label for="description">Description</label>
                <textarea rows="7" name="description" id="task{{ $task->id }}_task-description" class="form-control">{{ $task->description }}</textarea>

                <label for="status">Status</label>
                <select name="status" id="task{{ $task->id }}_task-status" class="form-control">
                    <option value='{{ App\Task::STATUS_PENDING }}' {{ $task->status === App\Task::STATUS_PENDING ? 'selected=selected' : '' }}>{{ App\Task::$statusNames[App\Task::STATUS_PENDING] }}</option>
                    <option value='{{ App\Task::STATUS_INPROGRESS }}' {{ $task->status === App\Task::STATUS_INPROGRESS ? 'selected=selected' : '' }}>{{ App\Task::$statusNames[App\Task::STATUS_INPROGRESS] }}</option>
                    <option value='{{ App\Task::STATUS_COMPLETE }}' {{ $task->status ===  App\Task::STATUS_COMPLETE ? 'selected=selected' : '' }}>{{ App\Task::$statusNames[App\Task::STATUS_COMPLETE] }}</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="due">Due Date</label>
                <input type="text" name="due" id="task{{ $task->id }}_task-due" value='{{ $task->due->format('m/d/Y') }}' class="form-control" />

                <label for="priority">Priority</label>
                <select name="priority" id="task-priority" class="form-control">
                    <option value='{{ App\Task::PRIORITY_LOW }}' {{ $task->priority === App\Task::PRIORITY_LOW ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_LOW] }}</option>
                    <option value='{{ App\Task::PRIORITY_MEDIUM }}' {{ $task->priority === App\Task::PRIORITY_MEDIUM ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_MEDIUM] }}</option>
                    <option value='{{ App\Task::PRIORITY_HIGH }}' {{ $task->priority === App\Task::PRIORITY_HIGH ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_HIGH] }}</option>
                    <option value='{{ App\Task::PRIORITY_CRITICAL }}' {{ $task->priority === App\Task::PRIORITY_CRITICAL ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_CRITICAL] }}</option>
                </select>

                <label for="assignee">Assignee</label>
                <input type="text" READONLY name="assignee" id="task{{ $task->id }}_task-assignee" value='{{ $task->assignee }}' class="form-control" />

                <label for="assignee">Created</label>
                <input type="text" READONLY name="created" id="task{{ $task->id }}_task-created" value='{{ $task->created_at->setTimezone("America/New_York")->format("Y-m-d g:i:s A") }}' class="form-control" />

                <label for="assignee">Last Updated</label>
                <input type="text" READONLY name="updated_at" id="task{{ $task->id }}_task-updated_at" value='{{ $task->updated_at->setTimezone("America/New_York")->format("Y-m-d g:i:s A") }}' class="form-control" />
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-6">
            <!-- Edit Task Button -->
            <button class="btn btn-default" onclick='document.forms["update-task-form_{{ $task->id }}"].submit();'>
                <i class="fa fa-edit"></i> Update Task
            </button>
        </div>

        <div class="col-sm-6">
            <form action='/task/{{ $task->id }}' name='delete-task-form_{{ $task->id }}' onsubmit="return confirm('Are you sure you want to delete this task?');" method='POST' class='form-horizontal'>
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <!-- Delete Task Button -->
                <button type='submit' class="btn btn-default">
                    <i class="fa fa-minus"></i> Delete Task
                </button>
            </form>
        </div>
    </div>
</div>
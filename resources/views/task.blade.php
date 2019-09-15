@auth
    @include('edittask', ['task' => $task])
@else
<div class='task_view'>
    <div class="row">
        {{ csrf_field() }}
        <div class="col-sm-6">
            <div><label>Owner:</label> <span class='nowrap'>{{ $task->user->name }}</span></div>
            <div><label>Status:</label> <span class='nowrap'>{{ App\Task::$statusNames[$task->status] }}</span></div>
            <div><label>Description:</label><br /> {{ $task->description }}</div>
        </div>
        <div class="col-sm-6">
            <div><label>Due Date:</label> {{ $task->due->format('m/d/Y') }}</div>
            <div><label>Priority:</label> {{ App\Task::$priorityNames[$task->priority] }}</div>
            <div><label>Assignee:</label> <span class='nowrap'>{{ $task->assignee }}</span></div>
            <div><label>Created:</label> <span class='nowrap'>{{ $task->created_at->setTimezone("America/New_York")->format("Y-m-d g:i:s A") }}</span></div>
            <div><label>Last Updated:</label> <span class='nowrap'>{{ $task->updated_at->setTimezone("America/New_York")->format("Y-m-d g:i:s A") }}</span></div>
        </div>
    </div>
</div>
@endauth
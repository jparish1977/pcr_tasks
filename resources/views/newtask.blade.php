<div class='new_task_form'>
    <form action='/task' name='new-task-form' method='POST' class='form-horizontal' autocomplete='off'>
        {{ csrf_field() }}

        <!-- Task Name -->
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="description">Description</label>
                    <textarea rows="7" name="description" id="task-description" placeholder="200 Character max" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="col-sm-6">
                    <label for="due">Due Date</label>
                    <input type="text" name="due" id="task-due" placeholder="MM/DD/YYY" value='{{ old('due') }}' class="form-control" />

                    <label for="priority">Priority</label>
                    <select name="priority" id="task-priority" class="form-control">
                        <option value='{{ App\Task::PRIORITY_LOW }}' {{ old('priority') === (string) App\Task::PRIORITY_LOW ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_LOW] }}</option>
                        <option value='{{ App\Task::PRIORITY_MEDIUM }}' {{ old('priority') === (string) App\Task::PRIORITY_MEDIUM ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_MEDIUM] }}</option>
                        <option value='{{ App\Task::PRIORITY_HIGH }}' {{ old('priority') === (string) App\Task::PRIORITY_HIGH ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_HIGH] }}</option>
                        <option value='{{ App\Task::PRIORITY_CRITICAL }}' {{ old('priority') === (string) App\Task::PRIORITY_CRITICAL ? 'selected=selected' : '' }}>{{ App\Task::$priorityNames[App\Task::PRIORITY_CRITICAL] }}</option>
                    </select>

                    <label for="assignee">Assignee</label>
                    <input type="text" name="assignee" id="task-assignee" placeholder="100 Character max" class="form-control" />
                </div>
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>
</div>
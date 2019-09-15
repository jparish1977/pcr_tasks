<h1>PHP Coding Project</h1>
<p>
    Using Laravel 5.7 or newer (6 was just released) build a Basic Task List Application.
</p>
<h2>Requirements</h2>
<p>
    The Web application should be able to do the following:
</p>
<ul>
    <li>Database: Mysql</li>
    <li>
        Required Fields
        <ul>
            <li>Date and Time the Task was added or Updated.</li>
            <li>Description of the Task. (200 Characters)</li>
            <li>
                Priority
                <ul>
                    <li>Low</li>
                    <li>Medium</li>
                    <li>High</li>
                    <li>Critical</li>                                    
                </ul>
            </li>
            <li>Name of person assigned the task (100 characters)</li>
            <li>Due Date for the Task</li>
            <li>
                Status
                <ul>
                    <li>Pending</li>
                    <li>In Progress</li>
                    <li>Complete</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
        Add Tasks
        <ul>
            <li>Creating the Task</li>
            <li>Include Validation
                <ul>
                    <li>Don’t allow duplicates, invalid data etc.</li>
                </ul>
            </li>
            <li>Displaying Existing Tasks and New tasks. The list should refresh after adding the task.</li>
        </ul>
    </li>
    <li>
        Updating Tasks
        <ul>
            <li>Existing Tasks should allow updating.</li>
            <li>
                Only allow the following to be updated:
                <ul>
                    <li>Priority</li>
                    <li>Description</li>
                    <li>Due Date</li>
                    <li>Status</li>
                </ul>
            </li>
            <li>Prevent Updating the Name field, a future enhancement will only allow admins and Team leads to update the name field.</li>
        </ul>
    </li>
    <li>
        Delete/Remove Tasks
        <ul>
            <li>Add the ability to delete existing tasks.
            <li>
                Add validation
                <ul>
                    <li>Account for items deleted by another user using the task list.</li>
                </ul>
            </li>
        </ul>
    </li>

</ul>

<h2>
    Bonus Points
</h2>
<p>
    This is not required but following a TDD design pattern and including Unit Tests is a plus.
</p>
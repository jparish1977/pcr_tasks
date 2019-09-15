<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('description', 200)->comment('Description of the Task. (200 Characters)');
            $table->unsignedTinyInteger('priority')->comment('0=Critical 1=High 2=Medium 3=Low');
            $table->string('assignee', 100)->comment('Name of person assigned the task');
            $table->date('due')->comment('Due Date for the Task');
            $table->unsignedTinyInteger('status')->comment('0=Pending 1=In Progress 2=Complete');
            $table->timestamps();// provides created_at, updated_at
            
            $table->unique(['description', 'assignee', 'due']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

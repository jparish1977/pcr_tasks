@extends('layouts.app')

@section('page_scripts')
@if(Auth::user())
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
<script>
    $( function() {
        $('input[name="due"]').datepicker();
    } );
</script>
@endif
@endsection

@section('page_styles')
<style>
    .new_task_form, 
    .edit_task_form, 
    .task_view{
        border: 1px solid gainsboro;
        padding: 1em;
        border-radius: 1em;
    }
    
    .new_task_form label, 
    .edit_task_form label, 
    .task_view label{
        font-weight: bold;
    }
    
    .nowrap{
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::user())
            @include('common.errors')
            @include('common.success')
            <div class="card">
                <div class="card-header">Add Task</div>

                <div class="card-body">
                    <div class='panel-body'>
                        @include('newtask')
                    </div>
                </div>
            </div>
            @endif
            
            <div class='card'>
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    <div class='panel-body'>
                        @if($tasks->count() > 0)
                            @foreach($tasks as $currentTask)
                            @include('task', ['task' => $currentTask])
                            @endforeach
                        @else
                            There are no tasks to display
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

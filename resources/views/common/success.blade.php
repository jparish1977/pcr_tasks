@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success!</strong>

        <br><br>

        {{ Session::get('success') }}
    </div>
@endif
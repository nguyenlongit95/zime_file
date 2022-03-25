@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('existed'))
    <div class="alert alert-warning">
        {{ session('existed') }}
    </div>
@elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
@endif

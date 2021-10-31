@if($errors->any())
    <div class="alert alret-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('timeerror'))
    <div class="alert alert-danger">
        {{ session('timeerror') }}
    </div>
@endif


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@switch(true)
    @case(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @break

    @case(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @break
@endswitch

@props([
    'actionRoute' => '', 
    'searchQuery' => ''
])

<div class="form-group">
    <form action="{{ route($actionRoute) }}" method="get">
        <div class="input-group">
            <input class="form-control" name="search" placeholder="Search by id..." value="{{ $searchQuery }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
@props([
    'actionRoute' => '', 
    'searchQuery' => '',
    'categoryId' => null
])

<div class="form-group">
    <form action="{{ route($actionRoute, ['category' => $categoryId]) }}" method="get">
        <div class="input-group">
            <input class="form-control" name="search" placeholder="Search by id..." value="{{ $searchQuery }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
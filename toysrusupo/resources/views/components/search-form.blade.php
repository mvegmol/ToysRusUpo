@props([
    'actionRoute' => '', 
    'searchQuery' => '',
    'categoryId' => null
])

<div class="mb-4">
    <form action="{{ route($actionRoute, ['category' => $categoryId]) }}" method="get">
        <div class="flex items-center">
            <input class="form-input border border-gray-300 rounded-l px-4 py-2" name="search" placeholder="Search by id..." value="{{ $searchQuery }}">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-r">Search</button>
        </div>
    </form>
</div>

@props([
    'route',
    'entity',
    'entityName',
    'showProductsButton' => false
])

<form action="{{ route($route . '.destroy', $entity->id) }}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{ route($route . '.show', $entity->id) }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-3 py-1 rounded mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.5 12s3-7.5 10.5-7.5S22.5 12 22.5 12s-3 7.5-10.5 7.5S1.5 12 1.5 12z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15.5A3.5 3.5 0 1 1 12 8.5a3.5 3.5 0 0 1 0 7z"/>
        </svg>                    
        Show
    </a>
    <a href="{{ route($route . '.edit', $entity->id) }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1 rounded mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 2.646a1.5 1.5 0 112.122 2.122L8.707 13.414l-4 4a1.5 1.5 0 01-.394.263l-3 1.5a1.5 1.5 0 01-1.368-2.736l1.5-3a1.5 1.5 0 01.263-.394l4-4L15.232 2.646z"/>
        </svg>
        Edit
    </a>
    @if($showProductsButton)
        <a href="{{ route($route . '.products', ['category' => $entity->id, 'resetPage' => 1, 'prevPage' => request()->page]) }}" class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-3 py-1 rounded mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 4 9-4" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v10" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4" />
            </svg>
                        
            Products
        </a>
    @endif
    <button type="submit" class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1 rounded" onclick="return confirm('Do you want to delete this {{ strtolower($entityName) }}?');">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        Delete
    </button>
</form>

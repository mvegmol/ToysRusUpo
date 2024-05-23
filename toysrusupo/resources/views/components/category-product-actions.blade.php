@props(['route', 'entity', 'entityName', 'category'])

<form action="{{ route($route . '.detach', ['category' => $category->id, 'product' => $entity->id]) }}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{ route('products.show', $entity->id) }}"
        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-3 py-1 rounded mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1.5 12s3-7.5 10.5-7.5S22.5 12 22.5 12s-3 7.5-10.5 7.5S1.5 12 1.5 12z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15.5A3.5 3.5 0 1 1 12 8.5a3.5 3.5 0 0 1 0 7z" />
        </svg>
        Show
    </a>
    <button type="submit"
        class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1 rounded"
        onclick="return confirm('Are you sure you want to remove this {{ strtolower($entityName) }} from the category?');">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Remove
    </button>
</form>

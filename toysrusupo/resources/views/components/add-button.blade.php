@props(['route', 'routeParams' => [], 'entityName'])

<a href="{{ route($route, $routeParams) }}" class="inline-flex items-center bg-primary hover:bg-tertiary text-white text-sm font-medium px-4 py-2 rounded my-2">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Add New {{ $entityName }}
</a>

@props(['route', 'routeParams' => [], 'entityName'])

<a href="{{ route($route, $routeParams) }}" class="btn btn-success btn-sm my-2">
    <i class="bi bi-plus-circle"></i> Add New {{ $entityName }}
</a>

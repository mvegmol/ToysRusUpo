@props(['route', 'routeParams' => []])

<a href="{{ route($route, $routeParams) }}" class="inline-flex items-center bg-primary hover:bg-tertiary text-white text-sm font-medium px-4 py-2 rounded">
    {{ $slot }}
</a>

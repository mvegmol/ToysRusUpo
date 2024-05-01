@props(['route', 'routeParams' => []])

<a href="{{ route($route, $routeParams) }}" class="btn btn-primary btn-sm">{{ $slot }}</a>
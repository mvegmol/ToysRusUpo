@props(['route', 'entity', 'entityName', 'category'])

<form action="{{ route($route . '.detach', ['category' => $category->id, 'product' => $entity->id]) }}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{ route($route . '.show', $entity->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
    <button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm('Are you sure you want to remove this {{ strtolower($entityName) }} from the category?');"><i
            class="bi bi-x-circle"></i> Remove</button>
</form>

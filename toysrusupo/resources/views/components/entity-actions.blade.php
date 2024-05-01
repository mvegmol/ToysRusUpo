@props([
    'route',
    'entity',
    'entityName',
    'showRentButton' => false
])

<form action="{{ route($route . '.destroy', $entity->id) }}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{ route($route . '.show', $entity->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
    <a href="{{ route($route . '.edit', $entity->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
    @if($showRentButton)
        <a href="{{ route($route . '.show-supports', $entity->id) }}" class="btn btn-info btn-sm"><i class="bi bi-cart4"></i> Rent</a>
    @endif
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this {{ strtolower($entityName) }}?');"><i class="bi bi-trash"></i> Delete</button>
</form>

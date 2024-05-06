@props([
    'route',
    'entity',
    'entityName',
    'showProductsButton' => false
])

<form action="{{ route($route . '.destroy', $entity->id) }}" method="post">
    @csrf
    @method('DELETE')
    <a href="{{ route($route . '.show', $entity->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
    <a href="{{ route($route . '.edit', $entity->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>    
    @if($showProductsButton)
        <a href="{{ route($route . '.products', ['category' => $entity->id, 'resetPage' => 1, 'prevPage' => request()->page]) }}" class="btn btn-success btn-sm"><i class="bi bi-box-seam"></i> Products</a>
    @endif
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this {{ strtolower($entityName) }}?');"><i class="bi bi-trash"></i> Delete</button>
</form>

@props([
    'entities',
    'headers',
    'fields',
    'actionsRoute',
    'entityName',
    'emptyMessage',
    'showProductsButton' => false,
    'showCategoryProductActions' => false,
    'category'
])

@php
    $isProductEntity = strtolower($entityName) === 'product';
@endphp

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th scope="col">Id</th>
            @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
            <th scope="col">Actions</th>
            @if ($isProductEntity)
                <th scope="col">Añadir al Carrito</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($entities as $entity)
            <tr>
                <th scope="row">
                    {{ $entity->id }}
                </th>
                @foreach ($fields as $field)
                    <td>{{ $entity->{$field} }}</td>
                @endforeach
                <td>
                    @if ($showCategoryProductActions == false)
                        <x-entity-actions :entity="$entity" :route="$actionsRoute" :entityName="$entityName" :showProductsButton="$showProductsButton" />
                    @else
                        <x-category-product-actions :entity="$entity" :route="$actionsRoute" :entityName="$entityName" :category="$category" />
                    @endif
                </td>
                @if ($isProductEntity)
                <td>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $entity->id }}">

                        <button type="submit" class="btn btn-danger">Añadir al Carrito</button>
                    </form>
                </td>

                @endif
            </tr>
        @empty
            <td colspan="{{ count($headers) + 2 + ($isProductEntity ? 1 : 0) }}">{{ $emptyMessage }}</td>
        @endforelse
    </tbody>
</table>

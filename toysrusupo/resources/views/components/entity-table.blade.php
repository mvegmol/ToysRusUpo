@props([
    'entities',
    'headers',
    'fields',
    'actionsRoute',
    'entityName',
    'emptyMessage',
    'showProductsButton' => false,
    'showCategoryProductActions' => false,
    'category',
])

@php
    $isProductEntity = strtolower($entityName) === 'product';
@endphp

<table class="min-w-full divide-y divide-gray-200 text-center">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
            @foreach ($headers as $header)
                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}</th>
            @endforeach
            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            @if (Auth::user()->role == 'admin')
            @else
                @if ($isProductEntity)
                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Añadir
                        al
                        Carrito</th>
                @endif
            @endif
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($entities as $entity)
            <tr>
                <th scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $entity->id }}
                </th>
                @foreach ($fields as $field)
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entity->{$field} }}</td>
                @endforeach
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    @if ($showCategoryProductActions == false)
                        <x-entity-actions :entity="$entity" :route="$actionsRoute" :entityName="$entityName" :showProductsButton="$showProductsButton" />
                    @else
                        <x-category-product-actions :entity="$entity" :route="$actionsRoute" :entityName="$entityName"
                            :category="$category" />
                    @endif
                </td>
                @if (Auth::user()->role == 'admin')
                @else
                    @if ($isProductEntity)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $entity->id }}">

                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Añadir al
                                    Carrito</button>
                            </form>
                        </td>
                    @endif
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headers) + 2 + ($isProductEntity ? 1 : 0) }}"
                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $emptyMessage }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

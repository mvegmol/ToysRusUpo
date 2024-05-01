@props(['entities', 'headers', 'fields', 'actionsRoute', 'entityName', 'emptyMessage'])

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th scope="col">Id</th>
            @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
            <th scope="col">Actions</th>
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
                    <x-entity-actions :entity="$entity" :route="$actionsRoute" :entityName="$entityName" />
                </td>
            </tr>
        @empty
            <td colspan="{{ count($headers) + 2 }}">{{ $emptyMessage }}</td>
        @endforelse
    </tbody>
</table>

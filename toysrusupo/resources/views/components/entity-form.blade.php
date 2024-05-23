@props([
    'actionUrl' => '',
    'fields' => [],
    'buttonLabel' => 'Save',
    'method' => 'POST',
])

<form action="{{ $actionUrl }}" method="post" class="space-y-6 max-w-lg mx-auto">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @foreach ($fields as $field)
        <div class="flex flex-col mb-4">
            <label for="{{ $field['id'] }}" class="font-medium text-gray-700 mb-2">{{ $field['label'] }}:</label>
            @if ($field['type'] === 'textarea')
                <textarea class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 @error($field['old']) border-red-500 @enderror"
                    id="{{ $field['id'] }}" name="{{ $field['name'] }}" {!! $field['attributes'] ?? '' !!}>{{ old($field['old'], $field['value'] ?? '') }}</textarea>
            @elseif ($field['type'] === 'select' && isset($field['multiple']) && $field['multiple'])
                <select class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 @error($field['old']) border-red-500 @enderror"
                    id="{{ $field['id'] }}" name="{{ $field['name'] }}" multiple>
                    @foreach ($field['options'] as $option)
                        <option value="{{ $option->id }}"
                            {{ in_array($option->id, old($field['old'], $field['selected'] ?? [])) ? 'selected' : '' }}>
                            {{ $option->name }}</option>
                    @endforeach
                </select>
            @else
                <input type="{{ $field['type'] }}"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 @error($field['old']) border-red-500 @enderror"
                    id="{{ $field['id'] }}" name="{{ $field['name'] }}"
                    value="{{ old($field['old'], $field['value'] ?? null) }}" {!! $field['attributes'] ?? '' !!}>
            @endif
            @error($field['old'])
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <div class="flex justify-center">
        <input type="submit" class="px-4 py-2 bg-primary hover:bg-tertiary text-white rounded-md"
            value="{{ $buttonLabel }}">
    </div>
</form>

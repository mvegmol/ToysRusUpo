@props([
    'actionUrl' => '',
    'fields' => [],
    'buttonLabel' => 'Save',
    'method' => 'POST',
])

<form action="{{ $actionUrl }}" method="post">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    @foreach ($fields as $field)
        <div class="mb-3 row">
            <label for="{{ $field['id'] }}"
                class="col-md-4 col-form-label text-md-end text-start">{{ $field['label'] }}:</label>
            <div class="col-md-6">
                @if ($field['type'] === 'textarea')
                    <textarea class="form-control @error($field['old']) is-invalid @enderror" id="{{ $field['id'] }}"
                        name="{{ $field['name'] }}" {!! $field['attributes'] ?? '' !!}>{{ old($field['old'], $field['value'] ?? '') }}</textarea>
                @elseif ($field['type'] === 'select' && isset($field['multiple']) && $field['multiple'])
                    <select class="form-control @error($field['old']) is-invalid @enderror" id="{{ $field['id'] }}"
                        name="{{ $field['name'] }}" multiple>
                        @foreach ($field['options'] as $option)
                            <option value="{{ $option->id }}"
                                {{ in_array($option->id, old($field['old'], $field['selected'] ?? [])) ? 'selected' : '' }}>
                                {{ $option->name }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="{{ $field['type'] }}" class="form-control @error($field['old']) is-invalid @enderror"
                        id="{{ $field['id'] }}" name="{{ $field['name'] }}"
                        value="{{ old($field['old'], $field['value'] ?? null) }}" {!! $field['attributes'] ?? '' !!}>
                @endif
                @error($field['old'])
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endforeach

    <div class="mb-3 row">
        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ $buttonLabel }}">
    </div>
</form>

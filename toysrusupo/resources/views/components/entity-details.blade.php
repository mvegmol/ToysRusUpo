<div>
    @foreach ($details as $detail)
        <div class="flex flex-col mb-4">
            <label class="font-medium text-gray-700 mb-2">
                <strong>{{ $detail['label'] }}:</strong>
            </label>
            <div class="p-2 bg-gray-100 rounded-md" style="line-height: 35px;">
                {{ $detail['value'] }}
            </div>
        </div>
    @endforeach
</div>

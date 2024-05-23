<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="bg-gray-100 px-6 py-4 border-b">
        {{ $header }}
    </div>
    <div class="px-6 py-4">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="bg-gray-100 px-6 py-4 border-t">
            {{ $footer }}
        </div>
    @endif
</div>

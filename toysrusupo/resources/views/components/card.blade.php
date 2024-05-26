<div class="bg-white shadow-xl shadow-secondary/40 rounded-lg overflow-hidden border border-secondary">
    <div class="bg-secondary px-6 py-4 border-b">
        {{ $header }}
    </div>
    <div class="px-6 py-4">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="bg-secondary px-6 py-4 border-t">
            {{ $footer }}
        </div>
    @endif
</div>

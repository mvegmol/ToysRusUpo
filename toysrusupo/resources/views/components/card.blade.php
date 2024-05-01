<div class="card">
    <div class="card-header">
        {{ $header }}        
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>

<div>
    @foreach ($details as $detail)
        <div class="row">
            <label
                class="col-md-4 col-form-label text-md-end text-start"><strong>{{ $detail['label'] }}:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $detail['value'] }}
            </div>
        </div>
    @endforeach
</div>

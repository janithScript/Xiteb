@extends('layouts.app')
@push('styles')
<style>
    #imagePreview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    #imagePreview img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Prescription</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Prescription Images (Max 5)</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror"
                                   name="images[]" multiple accept="image/*" required
                                   onchange="previewImages(this)">
                            <small class="text-muted">You can select up to 5 images</small>
                            <div id="imagePreview"></div>
                            @error('images')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea class="form-control @error('note') is-invalid @enderror"
                                      name="note" rows="3">{{ old('note') }}</textarea>
                            @error('note')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery Address</label>
                            <input type="text" class="form-control @error('delivery_address') is-invalid @enderror"
                                   name="delivery_address" value="{{ old('delivery_address') }}" required>
                            @error('delivery_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery Time Slot</label>
                            <select class="form-control @error('delivery_time') is-invalid @enderror"
                                    name="delivery_time" required>
                                @php
                                    $start = strtotime('tomorrow 09:00');
                                    $end = strtotime('tomorrow 17:00');
                                    while ($start <= $end) {
                                        $timeSlot = date('Y-m-d H:i:s', $start);
                                        echo "<option value='{$timeSlot}'>" . date('Y-m-d H:i', $start) . "</option>";
                                        $start = strtotime('+2 hours', $start);
                                    }
                                @endphp
                            </select>
                            @error('delivery_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Prescription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImages(input) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (input.files) {
        const filesAmount = input.files.length;
        if (filesAmount > 5) {
            alert('You can only select up to 5 images');
            input.value = '';
            return;
        }

        for (let i = 0; i < filesAmount; i++) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                preview.appendChild(img);
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
}
</script>
@endpush

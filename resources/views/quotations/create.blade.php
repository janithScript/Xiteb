@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Prescription Images Section -->
            <div class="card mb-4">
                <div class="card-header">Prescription Images</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($prescription->images as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     class="img-fluid rounded"
                                     alt="Prescription Image"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal{{ $loop->index }}">
                            </div>

                            <!-- Image Modal -->
                            <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 class="img-fluid"
                                                 alt="Prescription Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quotation Form -->
            <div class="card">
                <div class="card-header">
                    Create Quotation
                    <a href="{{ route('admin.prescriptions') }}" class="btn btn-secondary btn-sm float-end">Back</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('quotations.store', $prescription) }}" id="quotationForm">
                        @csrf
                        <div id="items">
                            <div class="row mb-2 fw-bold">
                                <div class="col">Drug Name</div>
                                <div class="col">(mg)</div>
                                <div class="col">Quantity</div>
                                <div class="col">Unit Price (Rs.)</div>
                                <div class="col">Total (Rs.)</div>
                                <div class="col-auto">Action</div>
                            </div>
                            <div id="itemsContainer">
                                <div class="item-row mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="items[0][drug_name]" class="form-control" placeholder="Enter drug name" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="items[0][strength]" class="form-control" placeholder="Enter strength (mg)" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" name="items[0][quantity]" class="form-control quantity" placeholder="Qty" required min="1">
                                        </div>
                                        <div class="col">
                                            <input type="number" step="0.01" name="items[0][unit_price]" class="form-control unit-price" placeholder="Price" required min="0">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control total-price" readonly value="0.00">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger btn-sm remove-item">×</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="button" id="addItemBtn" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add Another Drug
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Summary</h5>
                                        <div class="d-flex justify-content-between">
                                            <span>Total Items:</span>
                                            <span id="total-items">1</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h4>Grand Total:</h4>
                                            <h4>Rs. <span id="grand-total">0.00</span></h4>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mt-2">Create Quotation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemCount = 1;
    const itemsContainer = document.getElementById('itemsContainer');
    const addItemBtn = document.getElementById('addItemBtn');

    // Add new item row
    addItemBtn.addEventListener('click', function() {
        const template = document.querySelector('.item-row').cloneNode(true);

        template.querySelectorAll('input').forEach(input => {
            input.name = input.name ? input.name.replace('[0]', `[${itemCount}]`) : '';
            input.value = '';
            if (input.classList.contains('total-price')) {
                input.value = '0.00';
            }
        });

        itemsContainer.appendChild(template);
        itemCount++;
        updateTotalItems();

        // Add event listeners to new row
        addRowEventListeners(template);
    });

    // Remove item row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            if (document.querySelectorAll('.item-row').length > 1) {
                e.target.closest('.item-row').remove();
                calculateGrandTotal();
                updateTotalItems();
            }
        }
    });

    // Calculate row total
    function calculateRowTotal(row) {
        const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
        const total = quantity * unitPrice;
        row.querySelector('.total-price').value = total.toFixed(2);
        return total;
    }

    // Add event listeners to a row
    function addRowEventListeners(row) {
        const quantityInput = row.querySelector('.quantity');
        const unitPriceInput = row.querySelector('.unit-price');

        [quantityInput, unitPriceInput].forEach(input => {
            input.addEventListener('input', function() {
                calculateRowTotal(row);
                calculateGrandTotal();
            });
        });
    }

    // Calculate grand total
    function calculateGrandTotal() {
        const totals = Array.from(document.querySelectorAll('.total-price'))
            .map(input => parseFloat(input.value) || 0);
        const grandTotal = totals.reduce((sum, current) => sum + current, 0);
        document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
    }

    // Update total items count
    function updateTotalItems() {
        document.getElementById('total-items').textContent =
            document.querySelectorAll('.item-row').length;
    }

    // Initialize event listeners for existing rows
    document.querySelectorAll('.item-row').forEach(row => {
        addRowEventListeners(row);
    });
});
</script>
@endpush
@endsection

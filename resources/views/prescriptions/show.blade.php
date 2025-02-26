@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Prescription Details
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary float-end">Back</a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Prescription Images</h5>
                        <div class="row">
                            @foreach($prescription->images as $image)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                         class="img-fluid rounded"
                                         alt="Prescription Image">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Delivery Details</h5>
                        <p><strong>Address:</strong> {{ $prescription->delivery_address }}</p>
                        <p><strong>Time:</strong> {{ $prescription->delivery_time->format('Y-m-d H:i') }}</p>
                        @if($prescription->note)
                            <p><strong>Note:</strong> {{ $prescription->note }}</p>
                        @endif
                    </div>

                    @if($prescription->quotations->isNotEmpty())
                        <div class="mb-4">
                            <h5>Quotation Details</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Drug Name</th>
                                            <th> (mg)</th>
                                            <th>Quantity</th>
                                            <th>Unit Price (Rs.)</th>
                                            <th>Total (Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prescription->quotations->first()->items as $item)
                                            <tr>
                                                <td>{{ $item->drug_name }}</td>
                                                <td>{{ $item->strength }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->unit_price, 2) }}</td>
                                                <td>{{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-primary">
                                            <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                            <td><strong>Rs. {{ number_format($prescription->quotations->first()->total_amount, 2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

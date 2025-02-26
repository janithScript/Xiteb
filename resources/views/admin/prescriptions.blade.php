@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Manage Prescriptions
                    <form action="{{ route('logout') }}" method="POST" class="float-end">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Delivery Address</th>
                                    <th>Delivery Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $prescription->user->name }}</td>
                                    <td>{{ $prescription->delivery_address }}</td>
                                    <td>{{ $prescription->delivery_time->format('Y-m-d H:i') }}</td>
                                    <td>
                                        @if($prescription->quotations->count() > 0)
                                            Quotation Provided
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-info btn-sm">View</a>
                                        @if($prescription->quotations->count() == 0)
                                            <a href="{{ route('quotations.create', $prescription) }}" class="btn btn-primary btn-sm">Create Quotation</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

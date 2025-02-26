@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <div class="float-end">
                        <a href="{{ route('prescriptions.create') }}" class="btn btn-primary me-2">Upload New Prescription</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h4>My Prescriptions</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
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
                                    <td>{{ $prescription->delivery_address }}</td>
                                    <td>{{ $prescription->delivery_time->format('Y-m-d H:i') }}</td>
                                    <td>{{ $prescription->status }}</td>
                                    <td>
                                        <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-sm btn-info">View</a>
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

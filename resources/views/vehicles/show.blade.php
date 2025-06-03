@extends('layouts.app')

@section('content')
    <h1>Vehicle Details</h1>

    <div class="card">
        <div class="card-header">
            Vehicle: {{ $vehicle->name }}
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $vehicle->name }}</p>
            <p><strong>Type:</strong> {{ $vehicle->type }}</p>
            <p><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</p>
            <p><strong>Created At:</strong> {{ $vehicle->created_at->format('Y-m-d H:i:s') }}</p>
            <p><strong>Last Updated:</strong> {{ $vehicle->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit Vehicle</a>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back to Vehicles</a>
        </div>
    </div>

    <h2 class="mt-4">Fuel Entries for this Vehicle</h2>
    @if($vehicle->fuelEntries->isEmpty())
        <p>No fuel entries for this vehicle yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Odometer Reading</th>
                    <th>Fuel Price/Liter</th>
                    <th>Amount (Liters)</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicle->fuelEntries->sortByDesc('entry_date') as $entry)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('Y-m-d') }}</td>
                        <td>{{ number_format($entry->odometer_reading, 2) }}</td>
                        <td>${{ number_format($entry->fuel_price_per_liter, 2) }}</td>
                        <td>{{ number_format($entry->fuel_amount_liters, 2) }}</td>
                        <td>${{ number_format($entry->total_cost, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
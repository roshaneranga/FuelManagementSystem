@extends('layouts.app')

@section('content')
    <h1>Fuel Reports</h1>

    <div class="card mb-4">
        <div class="card-header">
            Filter Reports
        </div>
        <div class="card-body">
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="vehicle_id" class="form-label">Vehicle</label>
                        <select class="form-select" id="vehicle_id" name="vehicle_id">
                            <option value="">All Vehicles</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $selectedVehicle == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->name }} ({{ $vehicle->type }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Clear Filters</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Summary
        </div>
        <div class="card-body">
            <p><strong>Total Fuel Consumed:</strong> {{ number_format($totalFuelConsumed, 2) }} Liters</p>
            <p><strong>Total Cost:</strong> ${{ number_format($totalCost, 2) }}</p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Vehicle</th>
                <th>Odometer Reading</th>
                <th>Fuel Type</th>
                <th>Fuel Price/Liter</th>
                <th>Fuel Amount (Liters)</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $entry)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('Y-m-d') }}</td>
                    <td>{{ $entry->vehicle->name }} ({{ $entry->vehicle->fuel_type }})</td>
                    <td>{{ number_format($entry->odometer_reading, 2) }}</td>
                    <td>{{ $entry->vehicle->fuel_type }}</td>
                    <td>${{ number_format($entry->fuel_price_per_liter, 2) }}</td>
                    <td>{{ number_format($entry->fuel_amount_liters, 2) }}</td>
                    <td>${{ number_format($entry->total_cost, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No fuel entries found for the selected criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
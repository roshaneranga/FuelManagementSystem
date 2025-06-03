@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Fuel Entries</h1>
        <a href="{{ route('fuel-entries.create') }}" class="btn btn-primary">Add New Fuel Entry</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehicle</th>
                <th>Odometer Reading</th>
                <th>Fuel Price/Liter</th>
                <th>Amount (Liters)</th>
                <th>Total Cost</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fuelEntries as $entry)
                <tr>
                    <td>{{ $entry->id }}</td>
                    <td>{{ $entry->vehicle->name }} ({{ $entry->vehicle->fuel_type }})</td>
                    <td>{{ number_format($entry->odometer_reading, 2) }}</td>
                    <td>${{ number_format($entry->fuel_price_per_liter, 2) }}</td>
                    <td>{{ number_format($entry->fuel_amount_liters, 2) }}</td>
                    <td>${{ number_format($entry->total_cost, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('fuel-entries.show', $entry->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('fuel-entries.edit', $entry->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('fuel-entries.destroy', $entry->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No fuel entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
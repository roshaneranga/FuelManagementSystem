@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vehicles</h1>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add New Vehicle</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Fuel Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->fuel_type }}</td>
                    <td>
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@extends('layouts.app')

@section('content')
    <h1>Add New Vehicle</h1>

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Vehicle Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Vehicle Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
        </div>
        <div class="mb-3">
            <label for="fuel_type" class="form-label">Fuel Type</label>
            <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ old('fuel_type') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Vehicle</button>
    </form>
@endsection
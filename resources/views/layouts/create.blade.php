@extends('layouts.app')

@section('content')
    <h1>Add New Fuel Entry</h1>

    <form action="{{ route('fuel-entries.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Vehicle</label>
            <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                <option value="">Select a Vehicle</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->name }} ({{ $vehicle->type }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fuel_type_display" class="form-label">Fuel Type (Auto-filled)</label>
            <input type="text" class="form-control" id="fuel_type_display" disabled>
        </div>

        <div class="mb-3">
            <label for="odometer_reading" class="form-label">Odometer Reading</label>
            <input type="number" step="0.01" class="form-control" id="odometer_reading" name="odometer_reading" value="{{ old('odometer_reading') }}" required>
        </div>

        <div class="mb-3">
            <label for="fuel_price_per_liter" class="form-label">Fuel Price Per Liter</label>
            <input type="number" step="0.01" class="form-control" id="fuel_price_per_liter" name="fuel_price_per_liter" value="{{ old('fuel_price_per_liter') }}" required>
        </div>

        <div class="mb-3">
            <label for="fuel_amount_liters" class="form-label">Fuel Amount (Liters)</label>
            <input type="number" step="0.01" class="form-control" id="fuel_amount_liters" name="fuel_amount_liters" value="{{ old('fuel_amount_liters') }}" required>
        </div>

        <div class="mb-3">
            <label for="total_cost_display" class="form-label">Total Cost (Auto-calculated)</label>
            <input type="text" class="form-control" id="total_cost_display" disabled>
        </div>

        <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" class="form-control" id="entry_date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Fuel Entry</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vehicleSelect = document.getElementById('vehicle_id');
            const fuelTypeDisplay = document.getElementById('fuel_type_display');
            const fuelPriceInput = document.getElementById('fuel_price_per_liter');
            const fuelAmountInput = document.getElementById('fuel_amount_liters');
            const totalCostDisplay = document.getElementById('total_cost_display');

            function getFuelType() {
                const vehicleId = vehicleSelect.value;
                if (vehicleId) {
                    fetch(`/vehicles/get-fuel-type/${vehicleId}`)
                        .then(response => response.json())
                        .then(data => {
                            fuelTypeDisplay.value = data.fuel_type;
                        })
                        .catch(error => {
                            console.error('Error fetching fuel type:', error);
                            fuelTypeDisplay.value = 'N/A';
                        });
                } else {
                    fuelTypeDisplay.value = '';
                }
            }

            function calculateTotalCost() {
                const price = parseFloat(fuelPriceInput.value);
                const amount = parseFloat(fuelAmountInput.value);
                if (!isNaN(price) && !isNaN(amount) && amount > 0) {
                    const total = (price * amount).toFixed(2); // Keep 2 decimal places
                    totalCostDisplay.value = total;
                } else {
                    totalCostDisplay.value = '';
                }
            }

            vehicleSelect.addEventListener('change', getFuelType);
            fuelPriceInput.addEventListener('input', calculateTotalCost);
            fuelAmountInput.addEventListener('input', calculateTotalCost);

            // Initial calls if values are pre-filled (e.g., on form validation error)
            getFuelType();
            calculateTotalCost();
        });
    </script>
@endsection
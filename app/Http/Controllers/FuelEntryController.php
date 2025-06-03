<?php

namespace App\Http\Controllers;

use App\Models\FuelEntry;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelEntryController extends Controller
{
    public function index()
    {
        $fuelEntries = FuelEntry::with('vehicle')->latest()->get();
        return view('fuel_entries.index', compact('fuelEntries'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('fuel_entries.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'odometer_reading' => 'required|numeric|min:0',
            'fuel_price_per_liter' => 'required|numeric|min:0.01', // Ensure price is positive
            'total_cost' => 'required|numeric|min:0.01',       // Ensure cost is positive
            'entry_date' => 'required|date',
        ]);

        $fuelPricePerLiter = (float) $request->fuel_price_per_liter;
        $totalCost = (float) $request->total_cost;

        // Calculate fuel_amount_liters
        // Avoid division by zero
        if ($fuelPricePerLiter > 0) {
            $fuelAmountLiters = $totalCost / $fuelPricePerLiter;
        } else {
            // Handle cases where fuel price is zero (e.g., free fuel, or error)
            // You might want to return an error or set to 0 depending on your business logic
            return redirect()->back()->withInput()->withErrors(['fuel_price_per_liter' => 'Fuel price per liter cannot be zero.']);
        }


        FuelEntry::create(array_merge($request->all(), [
            'fuel_amount_liters' => round($fuelAmountLiters, 2) // Round to 2 decimal places for storage
        ]));

        return redirect()->route('fuel-entries.index')->with('success', 'Fuel entry added successfully!');
    }

    public function show(FuelEntry $fuelEntry)
    {
        return view('fuel_entries.show', compact('fuelEntry'));
    }

    public function edit(FuelEntry $fuelEntry)
    {
        $vehicles = Vehicle::all();
        return view('fuel_entries.edit', compact('fuelEntry', 'vehicles'));
    }

    public function update(Request $request, FuelEntry $fuelEntry)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'odometer_reading' => 'required|numeric|min:0',
            'fuel_price_per_liter' => 'required|numeric|min:0.01', // Ensure price is positive
            'total_cost' => 'required|numeric|min:0.01',       // Ensure cost is positive
            'entry_date' => 'required|date',
        ]);

        $fuelPricePerLiter = (float) $request->fuel_price_per_liter;
        $totalCost = (float) $request->total_cost;

        // Calculate fuel_amount_liters
        if ($fuelPricePerLiter > 0) {
            $fuelAmountLiters = $totalCost / $fuelPricePerLiter;
        } else {
            return redirect()->back()->withInput()->withErrors(['fuel_price_per_liter' => 'Fuel price per liter cannot be zero.']);
        }

        $fuelEntry->update(array_merge($request->all(), [
            'fuel_amount_liters' => round($fuelAmountLiters, 2) // Round to 2 decimal places for storage
        ]));

        return redirect()->route('fuel-entries.index')->with('success', 'Fuel entry updated successfully!');
    }

    public function destroy(FuelEntry $fuelEntry)
    {
        $fuelEntry->delete();
        return redirect()->route('fuel-entries.index')->with('success', 'Fuel entry deleted successfully!');
    }
}
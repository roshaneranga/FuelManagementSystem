<?php

    namespace App\Http\Controllers;

    use App\Models\FuelEntry;
    use App\Models\Vehicle;
    use Illuminate\Http\Request;
    use Carbon\Carbon;

    class ReportController extends Controller
    {
        public function index(Request $request)
        {
            $vehicles = Vehicle::all();
            $selectedVehicle = $request->input('vehicle_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = FuelEntry::with('vehicle');

            if ($selectedVehicle) {
                $query->where('vehicle_id', $selectedVehicle);
            }

            if ($startDate) {
                $query->whereDate('entry_date', '>=', $startDate);
            }

            if ($endDate) {
                $query->whereDate('entry_date', '<=', $endDate);
            }

            $reports = $query->latest('entry_date')->get();

            // Calculate totals for the filtered reports
            $totalFuelConsumed = $reports->sum('fuel_amount_liters');
            $totalCost = $reports->sum('total_cost');

            return view('reports.index', compact('reports', 'vehicles', 'selectedVehicle', 'startDate', 'endDate', 'totalFuelConsumed', 'totalCost'));
        }
    }
<?php
    namespace App\Http\Controllers;

    use App\Models\Vehicle;
    use Illuminate\Http\Request;

    class VehicleController extends Controller
    {
        public function index()
        {
            $vehicles = Vehicle::all();
            return view('vehicles.index', compact('vehicles'));
        }

        public function create()
        {
            return view('vehicles.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'fuel_type' => 'required|string|max:255',
            ]);

            Vehicle::create($request->all());
            return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
        }

        public function show(Vehicle $vehicle)
        {
            return view('vehicles.show', compact('vehicle'));
        }

        public function edit(Vehicle $vehicle)
        {
            return view('vehicles.edit', compact('vehicle'));
        }

        public function update(Request $request, Vehicle $vehicle)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'fuel_type' => 'required|string|max:255',
            ]);

            $vehicle->update($request->all());
            return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
        }

        public function destroy(Vehicle $vehicle)
        {
            $vehicle->delete();
            return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
        }

        public function getFuelType($id)
        {
            $vehicle = Vehicle::find($id);
            if ($vehicle) {
                return response()->json(['fuel_type' => $vehicle->fuel_type]);
            }
            return response()->json(['fuel_type' => ''], 404);
        }
    }
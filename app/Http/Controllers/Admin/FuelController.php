<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsExport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\FuelConsumption;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class FuelController extends Controller
{
    public function index()
    {
        $fuelConsumptions = FuelConsumption::all();
        return view('admin.fuel_consumptions.index', compact('fuelConsumptions'));
    }


    public function create()
    {
        $cars = Car::all(); // Ambil semua data mobil
        return view('admin.fuel_consumptions.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ]);

        FuelConsumption::create($request->all());
        return redirect()->route('admin.fuel_consumptions.index');
    }

    public function edit(FuelConsumption $fuelConsumption)
    {
        $cars = Car::all();
        return view('admin.fuel_consumptions.edit', compact('fuelConsumption', 'cars'));
    }

    public function update(Request $request, FuelConsumption $fuelConsumption)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $fuelConsumption->update($request->all());
        return redirect()->route('admin.fuel_consumptions.index');
    }

    public function destroy(FuelConsumption $fuelConsumption)
    {
        $fuelConsumption->delete();
        return redirect()->route('admin.fuel_consumptions.index');
    }
}

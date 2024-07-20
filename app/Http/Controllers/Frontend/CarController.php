<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::where('status', 1);

        if ($request->category_id && $request->penumpang) {
            $cars = $cars->Where('type_id', $request->category_id)->Where('penumpang', '>=', $request->penumpang);
        }

        $cars = $cars->get();
        return view('frontend.car.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('frontend.car.show', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
            'nomer_wa' => 'required|string|max:255',
            'rent_days' => 'required|integer|min:1',
        ]);

        $car = Car::find($request->car_id);
        $total_price = $car->price * $request->rent_days;

        Booking::create([
            'car_id' => $request->car_id,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nomer_wa' => $request->nomer_wa,
            'rent_days' => $request->rent_days,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking created successfully.');
    }
}

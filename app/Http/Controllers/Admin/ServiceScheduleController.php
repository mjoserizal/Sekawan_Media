<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsExport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\FuelConsumption;
use App\Models\ServiceSchedule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ServiceScheduleController  extends Controller
{
    public function index()
    {
        $serviceSchedules = ServiceSchedule::with('car')->get();
        return view('admin.service_schedules.index', compact('serviceSchedules'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('admin.service_schedules.create', compact('cars'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'car_id' => 'required|exists:cars,id',
    //         'service_date' => 'required|date',
    //         'description' => 'required|string',
    //     ]);

    //     ServiceSchedule::create($request->all());

    //     return redirect()->route('admin.service_schedules.index')->with('success', 'Jadwal servis berhasil ditambahkan.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $servis = new ServiceSchedule();
        $servis->car_id = $request->car_id;
        $servis->service_date = $request->service_date;
        $servis->description = $request->description;
        $servis->save();

        // Update status car
        $car = Car::findOrFail($request->car_id);
        $currentDate = now()->startOfDay();
        $servisDate = \Carbon\Carbon::parse($request->service_date)->startOfDay();

        if ($servisDate->isSameDay($currentDate)) {
            // Tanggal servis adalah hari ini
            $car->status = 2;
        } elseif ($servisDate->isSameDay($currentDate->addDay())) {
            // Tanggal servis adalah besok
            $car->status = 2;
        }

        $car->save();

        return redirect()->back()->with([
            'message' => 'Servis berhasil ditambahkan dan status mobil diperbarui!',
            'alert-type' => 'success'
        ]);
    }

    public function edit(ServiceSchedule $serviceSchedule)
    {
        $cars = Car::all();
        return view('admin.service_schedules.edit', compact('serviceSchedule', 'cars'));
    }

    public function update(Request $request, ServiceSchedule $serviceSchedule)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $serviceSchedule->update($request->all());

        return redirect()->route('admin.service_schedules.index')->with('success', 'Jadwal servis berhasil diperbarui.');
    }

    public function destroy(ServiceSchedule $serviceSchedule)
    {
        // Ambil mobil yang terkait dengan jadwal servis
        $car = $serviceSchedule->car;

        // Hapus jadwal servis
        $serviceSchedule->delete();

        // Update status mobil menjadi 1
        $car->status = 1;
        $car->save();

        return redirect()->route('admin.service_schedules.index')->with('success', 'Jadwal servis berhasil dihapus dan status mobil diperbarui.');
    }
}

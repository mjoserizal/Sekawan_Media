<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('car')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $cars = Car::all();
        return view('admin.bookings.edit', compact('booking', 'cars'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'kilometers' => 'nullable|numeric',
            'fuel_used' => 'nullable|numeric',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with([
            'message' => 'berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $user = auth()->user();

        // Jika pengguna adalah admin, set status langsung ke approved
        if ($user->role == 'admin') {
            $booking->status = 'approved';
            $booking->approval_count = 2; // Asumsi admin langsung menyetujui, jadi set ke 2

            // Update status mobil menjadi 0 (misalnya, 0 berarti sudah disewa)
            $car = $booking->car;
            $car->status = 0; // Atau nilai sesuai yang Anda gunakan untuk menandakan mobil disewa
            $car->save();
        } else if ($user->role == 'approval') {
            // Jika pengguna adalah approval dan approval_count < 1, increment
            if ($booking->approval_count < 1) {
                $booking->approval_count += 1;

                // Set status ke approved jika approval_count sudah mencapai 2
                if ($booking->approval_count >= 2) {
                    $booking->status = 'approved';

                    // Update status mobil menjadi 0 (misalnya, 0 berarti sudah disewa)
                    $car = $booking->car;
                    $car->status = 0; // Atau nilai sesuai yang Anda gunakan untuk menandakan mobil disewa
                    $car->save();
                }
            } else {
                return redirect()->back()->with([
                    'message' => 'Anda sudah memberikan persetujuan pada booking ini!',
                    'alert-type' => 'warning'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'message' => 'Anda tidak memiliki hak untuk melakukan tindakan ini!',
                'alert-type' => 'danger'
            ]);
        }

        $booking->save();

        return redirect()->back()->with([
            'message' => 'Booking berhasil disetujui!',
            'alert-type' => 'success'
        ]);
    }



    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        // Set status to rejected
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->back()->with([
            'message' => 'tidak disetujui !',
            'alert-type' => 'danger'
        ]);
    }
    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        // Pastikan booking sudah disetujui sebelum diubah menjadi selesai
        if ($booking->status != 'approved') {
            return redirect()->back()->with([
                'message' => 'Booking harus disetujui terlebih dahulu!',
                'alert-type' => 'warning'
            ]);
        }

        $booking->status = 'completed';
        $booking->save();

        // Update status mobil menjadi 1 (misalnya, 1 berarti tersedia)
        $car = $booking->car;
        $car->status = 1; // Sesuaikan dengan nilai yang Anda gunakan untuk menandakan mobil tersedia
        $car->save();

        return redirect()->back()->with([
            'message' => 'Booking berhasil ditandai sebagai selesai!',
            'alert-type' => 'success'
        ]);
    }
}

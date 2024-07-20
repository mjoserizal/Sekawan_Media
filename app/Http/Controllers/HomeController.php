<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil data booking
        $bookings = Booking::all();

        // Hitung total booking
        $totalBookings = $bookings->count();

        // Hitung total harga sewa
        $totalPrice = $bookings->sum('total_price');

        // Hitung total hari sewa
        $totalDaysRented = $bookings->sum('rent_days');

        // Hitung rata-rata harga sewa
        $averagePrice = $totalBookings > 0 ? $totalPrice / $totalBookings : 0;

        // Hitung rata-rata hari sewa
        $averageDaysRented = $totalBookings > 0 ? $totalDaysRented / $totalBookings : 0;

        // Kirim data ke view
        return view('home', [
            'totalBookings' => $totalBookings,
            'totalPrice' => $totalPrice,
            'totalDaysRented' => $totalDaysRented,
            'averagePrice' => $averagePrice,
            'averageDaysRented' => $averageDaysRented
        ]);
    }
}

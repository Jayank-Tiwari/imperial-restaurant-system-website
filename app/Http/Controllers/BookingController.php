<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class BookingController extends Controller
{
    // Show booking form for users
    public function homeindex()
    {
        return view('booking');
    }

    // Store booking
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a table.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'guests' => 'required|integer|min:1',
            'occasion' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        Bookings::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'guests' => $request->guests,
            'status' => 0, // default to pending
            'occasion' => $request->occasion,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->back()->with('success', 'Your table request has been successfully recieved login to check for confirmation!');
    }

    // Admin view with filtering, sorting, search and pagination
    public function index(Request $request)
    {
        $query = Bookings::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('reservation_date', 'like', "%$search%")
                    ->orWhere('reservation_time', 'like', "%$search%")
                    ->orWhere('occasion', 'like', "%$search%");
            });
        }

        // Status filter
        if ($request->filled('status') && is_numeric($request->status)) {
            $query->where('status', (int) $request->status);
        }

        // Date range filter
        if ($request->filled('reservation_date')) {
            $query->where('reservation_date', $request->input('reservation_date'));
        }


        // Sorting
        $allowedSorts = ['id', 'first_name', 'phone', 'reservation_date', 'guests'];
        $sortField = in_array($request->input('sort'), $allowedSorts) ? $request->input('sort') : 'reservation_date';
        $sortDirection = $request->input('sort_dir') === 'asc' ? 'asc' : 'desc';

        $bookings = $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->appends($request->query());

        return view('admin.booking.index', compact('bookings'));
    }



    public function edit($id)
    {
        $booking = Bookings::findOrFail($id);
        return view('admin.booking.edit', compact('booking'));
    }

    // Handle update
    public function update(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:1,2,0',
            'occasion' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.booking')->with('success', 'Booking updated successfully.');
    }
}

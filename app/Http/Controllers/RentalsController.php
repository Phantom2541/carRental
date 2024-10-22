<?php

namespace App\Http\Controllers;

use App\Models\Rentals;
use Illuminate\Http\Request;
use App\Models\Cars; 
use App\Models\User; 
class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rentals::with(['car', 'user'])->get();

    return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
        {
            $rental = Rentals::findOrFail($id);

            // Update the status of the rental to approved
            $rental->approve = 'approved';
            $rental->save();

            return redirect()->route('rentals.index')->with('success', 'Rental approved successfully.');
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function create()
{
    // Fetch available cars and users for the rental form
    $cars = Cars::whereDoesntHave('rentals', function ($query) {
        $query->where('isActive', 1) // Only consider active rentals
              ->where(function ($q) {
                  $q->whereBetween('start_date', [request('start_date'), request('end_date')])
                    ->orWhereBetween('end_date', [request('start_date'), request('end_date')]);
              });
    })->get();

    $users = User::all(); // Fetch all users

    return view('rentals.create', compact('cars', 'users'));
}

public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'userId' => 'required|exists:users,id',
        'carId' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Check if the car is already booked in the specified date range
    $existingRental = Rentals::where('carId', $validated['carId'])
        ->where('is_active', 1) // Only consider active rentals
        ->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
        })
        ->exists();

    if ($existingRental) {
        return back()->withErrors(['carId' => 'The selected car is already booked for the selected dates.']);
    }

    // Create a new rental record in the database
    Rentals::create($validated);

    return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
}


   
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function show(Rentals $rentals)
    {
        // Return the view for showing the specific rental details
        return view('rentals.show', compact('rentals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function edit(Rentals $rentals)
    {
        // Return the view for editing the rental
        return view('rentals.edit', compact('rentals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rentals $rentals)
    {
        // Validate the request
        $validated = $request->validate([
            'carId' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after:rental_date',
            'price' => 'required|numeric',
        ]);

        // Update the rental record
        $rentals->update($validated);

        // Redirect to the rentals index with a success message
        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rentals $rentals)
    {
        // Delete the rental
        $rentals->delete();

        // Redirect back with a success message
        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }
}

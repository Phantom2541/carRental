<?php

namespace App\Http\Controllers;

use App\Models\Rentals;
use Illuminate\Http\Request;
use App\Models\Cars; 
use App\Models\User; 
use Carbon\Carbon;
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
    // Find the car and set its price
    $car = Cars::findOrFail($request->carId);

    // Validate the request data (without userId)
    $validated = $request->validate([
        'carId' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Calculate rental days
    $startDate = Carbon::parse($validated['start_date']);
    $endDate = Carbon::parse($validated['end_date']);
    $rentalDays = $startDate->diffInDays($endDate) + 1;

    // Check if the car is already booked in the specified date range
    $existingRental = Rentals::where('carId', $validated['carId'])
        ->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
        })
        ->exists();

    if ($existingRental) {
        return back()->withErrors(['carId' => 'The selected car is already booked for the selected dates.']);
    }

    // Add userId and calculated price to the validated data
    $validated['userId'] = auth()->id(); // Assign the logged-in user's ID
    $validated['price'] = $car->price * $rentalDays;

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
    public function edit(Rentals $rental)
    {
          $cars = Cars::all(); // Assuming you want to display available cars to choose from
    return view('rentals.edit', compact('rental', 'cars'));
        // Return the view for editing the rental
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rentals  $rentals
     * @return \Illuminate\Http\Response
     */

public function update(Request $request, Rentals $rental)
{
    // Validate the request data
    $validated = $request->validate([
        'carId' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Calculate the number of days between start_date and end_date
    $startDate = Carbon::parse($validated['start_date']);
    $endDate = Carbon::parse($validated['end_date']);
    $rentalDays = $startDate->diffInDays($endDate) + 1;

    // Find the car to get its daily price
    $car = Cars::findOrFail($validated['carId']);
    $totalPrice = $car->price * $rentalDays;

    // Set the logged-in user as the renter and add the calculated price
    $validated['userId'] = auth()->id();
    $validated['price'] = $totalPrice;

    // Update the rental with the validated data
    $rental->update($validated);

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

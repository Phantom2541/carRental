<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all cars from the database
        $cars = Cars::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show the form to create a new car
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Create a new car record in the database
        Cars::create([
            'name' => $request->name,
            'model' => $request->model, // Encrypt the password
            'brand' => $request->brand,
            'plateNum' => $request->plateNum,
            'gas' => $request->gas,
            'yearModel' => $request->yearModel,
            'isActive' => $request->isActive == 1 ? 1 : 0,
            'price' => $request->price
        ]);

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cars  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Cars $car)
    {
         $cars = Cars::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cars  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $car = Cars::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cars  $car
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Cars $car)
{
    // return $car;
    // Update the car record in the database
    $car->update([
        'name' => $request->name,
        'model' => $request->model,
        'brand' => $request->brand,
        'plateNum' => $request->plateNum,
        'gas' => $request->price,
        'price' => $request->gas,
        'year' => $request->year, // Changed yearModel to year to match the input name
        'is_active' => $request->is_active, // Changed isActive to is_active to match the input name
    ]);

    return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cars $car)
    {
        // Delete the car from the database
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}

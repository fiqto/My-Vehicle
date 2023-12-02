<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;

class DriverController extends Controller
{
    protected $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $drivers = Driver::all();
        return view('driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        //
        $this->driver->create($request->validated());

        return redirect()->route('drivers.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
        return view('driver.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
        return view('driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        //
        $driver->update($request->validated());

        return redirect()->route('drivers.index')
            ->with('success', 'Berhasil DiSimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
        $driver->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Berhasil DiHapus!');
    }
}

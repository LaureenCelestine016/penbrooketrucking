<?php

namespace App\Http\Controllers;

use App\Models\Trailer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trailers = Trailer::orderBy('created_at', 'desc')->get();

        return Inertia::render('Trailer/Index', ['trailers' => $trailers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Trailer/Create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'license_plate'      => 'required|string|max:10|unique:trailers,license_plate',
            'body_number'        => 'required|string|max:20|unique:trailers,body_number',
            'status'             => 'required|string|max:50',
            'calibrationDate'    => 'nullable|date',
            'calibrationExpDate' => 'nullable|date',
            'LTOregDate'         => 'nullable|date',
            'LTOExpDate'         => 'nullable|date',
            'conveyanceDate'     => 'nullable|date',
            'conveyanceExpDate'  => 'nullable|date',
            'filcomFabDate'      => 'nullable|date',
            'filconExpDate'      => 'nullable|date',
            'LTFRBRegDate'       => 'nullable|date',
            'LTFRBExpDate'       => 'nullable|date',
        ]);

        Trailer::create([
            'license_plate'                => $validatedData['license_plate'],
            'body_number'                  => $validatedData['body_number'],
            'status'                       => $validatedData['status'],
            'calibration_date'             => $validatedData['calibrationDate'],
            'calibration_exp_date'         => $validatedData['calibrationExpDate'],
            'lto_reg_date'                 => $validatedData['LTOregDate'],
            'lto_exp_date'                 => $validatedData['LTOExpDate'],
            'conveyance_date'              => $validatedData['conveyanceDate'],
            'conveyance_exp_date'          => $validatedData['conveyanceExpDate'],
            'filcom_fab_date'              => $validatedData['filcomFabDate'],
            'filcon_exp_date'              => $validatedData['filconExpDate'],
            'ltfrb_reg_date'               => $validatedData['LTFRBRegDate'],
            'ltfrb_exp_date'               => $validatedData['LTFRBExpDate'],
        ]);

        return redirect()->route('trailer')->with('success', 'Trailer truck created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Trailer $trailer)
    {
        return Inertia::render('Trailer/Show', ["trailer" => $trailer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trailer $trailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trailer $trailer)
    {

        $validatedData = $request->validate([
            'license_plate'      => 'required|string|max:10|unique:trailers,license_plate,'. $trailer->id,
            'body_number'        => 'required|string|max:20|unique:trailers,body_number,'. $trailer->id,
            'status'             => 'required|string|max:50',
            'calibrationDate'    => 'nullable|date',
            'calibrationExpDate' => 'nullable|date',
            'LTOregDate'         => 'nullable|date',
            'LTOExpDate'         => 'nullable|date',
            'conveyanceDate'     => 'nullable|date',
            'conveyanceExpDate'  => 'nullable|date',
            'filcomFabDate'      => 'nullable|date',
            'filconExpDate'      => 'nullable|date',
            'LTFRBRegDate'       => 'nullable|date',
            'LTFRBExpDate'       => 'nullable|date',
        ]);

        $trailer->update($validatedData);

        return redirect()->route('trailer.show', $trailer);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trailer $trailer)
    {
        $trailer->delete();

        return redirect()->route('trailer');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Trailer::whereIn('id', $ids)->delete();

        return redirect()->route('trailer');
    }
}

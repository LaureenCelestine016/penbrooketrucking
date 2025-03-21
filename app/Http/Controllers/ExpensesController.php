<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Expenses_Caterogry;
use App\Models\Trailer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Expenses/Index',['expenses' => Expenses::with('tractor','trailer','category')->orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Expenses/Create',[
            "trailer" =>  Trailer::where('status','Operational')->orderBy('created_at', 'desc')->get(['id', 'license_plate']),

            "tructor" =>  Vehicle::where('status','Operational')->orderBy('created_at', 'desc')->get(['id', 'license_plate']),

            "categories" => Expenses_Caterogry::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'tructorId'          => 'nullable|integer',
            'trailerId'          => 'nullable|integer',
            'category'           => 'required|integer',
            'cost'               => 'required|integer',
            'expenseDate'        => 'required|date',
            'description'        => 'nullable|string',
        ]);

        Expenses::create([
            'vehicle_id'             => $validatedData['tructorId'],
            'trailer_id'             => $validatedData['trailerId'],
            'category_id'            => $validatedData['category'],
            'amount'                 => $validatedData['cost'],
            'expense_date'           => $validatedData['expenseDate'],
            'description'            => $validatedData['description'],

        ]);

        return redirect()->route('expenses')->with('success', 'Expense created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        $expenses->delete();
        return redirect()->route('expenses');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Expenses::whereIn('id', $ids)->delete();

        return redirect()->route('expenses');
    }
}

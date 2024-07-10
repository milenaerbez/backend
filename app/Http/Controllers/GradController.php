<?php

namespace App\Http\Controllers;

use App\Models\Grad;
use Illuminate\Http\Request;

class GradController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function gradoviOdDrzave(Request $request)
    {
        try {
            $drzavaId = $request->input('drzavaId');


            $gradovi = Grad::where('drzava_id', $drzavaId)->get();

            return response()->json($gradovi);
        } catch (\Exception $e) {
            return response()->json('greska kod ucitavanja');
        }

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
    public function show(Grad $grad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grad $grad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grad $grad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grad $grad)
    {
        //
    }
}
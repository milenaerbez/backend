<?php

namespace App\Http\Controllers;

use App\Models\Drzava;
use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DrzavaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drzave = Drzava::all();

        // Return the data as a JSON response
        return response()->json($drzave);
    }

    public function drzavaZaId(Request $request)
    {
        try {

            $kandidatId = $request->input('kandidat_id');
            $kandidat = Kandidat::findOrFail($kandidatId);


            $drzava = $kandidat->drzava;


            return response()->json($drzava);
        } catch (\Exception $e) {
            
            Log::info('Greška kod DRZAVE: ' . $e->getMessage());
            return response()->json(['error' => 'Drzava not found'], 404);
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
    public function show(Drzava $drzava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drzava $drzava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Drzava $drzava)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drzava $drzava)
    {
        //
    }
}
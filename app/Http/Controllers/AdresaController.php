<?php

namespace App\Http\Controllers;

use App\Models\Adresa;
use App\Models\Grad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Adresa $adresa)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adresa $adresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adresa $adresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adresa $adresa)
    {
        //
    }

    public function showAddressesInCity(Request $request)
    {
        try {
            $gradId = $request->input('gradId');


            $adrese = Adresa::where('grad_id', $gradId)->get();

            return response()->json($adrese);
        } catch (\Exception $e) {
            Log::info('Greška kod adrese: ' . $e->getMessage());
            return response()->json('greska kod ucitavanja');
        }

    }
}
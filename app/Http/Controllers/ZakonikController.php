<?php

namespace App\Http\Controllers;

use App\Models\Clan_Zakonika;
use App\Models\Zakonik;
use Illuminate\Http\Request;

class ZakonikController extends Controller
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
    public function show()
    {
        $zakoni = Zakonik::all();
        return $zakoni;
    }

    public function clanoviZakona(Request $request)
    {
        $id = $request->input('zakonikId');
        $clanovi = Clan_Zakonika::where('zakonik_id', $id)->get();

        return $clanovi;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zakonik $zakonik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zakonik $zakonik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zakonik $zakonik)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function kreirajKandidata(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'Ime' => 'required|string',
                'Prezime' => 'required|string',
                'JMBG' => 'required|string|unique:kandidat',
                'Kontakt' => 'required|string',
                'adresa_id' => 'required|integer',
                'grad_id' => 'required|integer',
                'drzava_id' => 'required|integer',
                'kucniBroj' => 'required|string',
            ]);
            $kandidat = Kandidat::create($validatedData);
            DB::commit();
            return response()->json([
                'message' => 'Kandidat je uspesno kreiran',
                'kandidat' => $kandidat
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Greška kod kreiranja kandidata: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function obrisiKandidata(Request $request)
    {


        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',


            ]);

            $id = $validatedData['id'];
            $kandidat = Kandidat::findOrFail($id);
            $kandidat->delete();

            return response()->json(['message' => 'Kandidat je uspesno obrisan'], 201);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Error kod brisanja kandidata'], 500);
        }

    }


    public function prikaziKandidate()
    {
        DB::beginTransaction();
        try {

            //$kandidati = Kandidat::all();
            $kandidati = Kandidat::with('grad')->get();
            DB::commit();

            return response()->json($kandidati);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error fetching candidates'], 500);
        }
    }

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
    public function show(Kandidat $kandidat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kandidat $kandidat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'Ime' => 'required',
                'Prezime' => 'required',
                'JMBG' => 'required',
                'Kontakt' => 'required',
                'adresa_id' => 'required',
                'grad_id' => 'required',
                'drzava_id' => 'required',
                'kucniBroj' => 'required',

            ]);


            $candidate = Kandidat::findOrFail($id);


            $candidate->update($validatedData);
            DB::commit();
            return response()->json(['message' => 'Kandidat je uspesno izmenjen'], 201);
        } catch (\Exception $e) {
            Log::info('Greška kod update kandidata: ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['message' => 'Kandidat nije uspesno izmenjen'], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kandidat $kandidat)
    {
        //
    }

    public function deleteKandidat(Request $request, Kandidat $kandidat)
    {
        try {


            // $kandidat->ugovori()->update(['kandidat_id' => null]);

            $kandidat->delete();

            return response()->json(['message' => 'Kandidat obrisan'], 201);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['message' => 'Error deleting kandidat', 'error' => $e->getMessage()], 500);
        }
    }
}
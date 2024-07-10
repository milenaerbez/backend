<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Stavka_Ugovora;
use App\Models\Ugovor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UgovorController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'ugovor.datum' => 'required|string',
                'ugovor.sadrzaj' => 'required|string',
                'ugovor.kandidat_id' => 'required|integer',
                'stavke.*.ID' => 'required|integer',

                'stavke.*.zakonik_id' => 'required|integer',
                'stavke.*.clan_id' => 'required|integer',
                'stavke.*.sadrzaj' => 'required|string',
            ]);
            $ugovor = Ugovor::create($validatedData['ugovor']);
            $stavkeData = [];
            foreach ($validatedData['stavke'] as $stavka) {
                $stavkeData[] = [
                    'id' => $stavka['ID'],
                    'ugovor_id' => $ugovor->id,
                    'sadrzaj' => $stavka['sadrzaj'],
                    'clan_id' => $stavka['clan_id'],
                    'zakonik_id' => $stavka['zakonik_id'],
                ];
            }
            Stavka_Ugovora::insert($stavkeData);
            DB::commit();
            return response()->json(['message' => 'Ugovor sa stavkama je kreiran'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['message' => 'Greska kod kreiranja ugovora'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $ugovori = Ugovor::with('kandidat')
                ->withCount('stavke')
                ->get();


            return response()->json($ugovori);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ugovor $ugovor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ugovor $ugovor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ugovor $ugovor)
    {
        //
    }

    public function storniraj(Request $request)
    {
        DB::beginTransaction();


        try {
            $id = $request->input('ugovorid');

            $ugovor = Ugovor::findOrFail($id);
            Stavka_Ugovora::where('ugovor_id', $id)->delete();
            $ugovor->delete();


            DB::commit();
            return response()->json(['message' => 'Ugovor je uspesno obrisan'], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            DB::rollBack();
            return response()->json(['message' => 'Ugovor nije obrisan'], 500);
        }
    }

    public function pretrazi(Request $request)
    {
        DB::beginTransaction();
        try {
            // $validateData = $request->validate(['jmbg' => 'required|string']);

            // $kandidati = Kandidat::where('JMBG', $validateData)->get();
            // \Log::info($kandidati);

            // $ugovori = [];

            // foreach ($kandidati as $kandidat) {
            //     $ugovoriKandidata = Ugovor::where('kandidat_id', $kandidat->id)->get();
            //     $ugovori = array_merge($ugovori, $ugovoriKandidata->toArray())->with;
            $validateData = $request->validate(['jmbg' => 'required|string']);


            $ugovori = Ugovor::whereHas('kandidat', function ($query) use ($validateData) {
                $query->where('jmbg', $validateData['jmbg']);
            })->with('kandidat')->withCount('stavke')->get();

            DB::commit();
            return response()->json($ugovori);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);

        }

    }

    public function prikaziStavke(Request $request)
    {
        DB::beginTransaction();
        try {
            $validateData = $request->validate(['selectedUgovorId' => 'required|integer']);
            $stavke = Stavka_Ugovora::where('ugovor_id', $validateData)->with('zakonik', 'clan')->get();
            DB::commit();

            return response()->json($stavke);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);

        }
    }

    public function azuriraj(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Log::info('Usao je u metodu');
            $validatedDataUgovor = $request->validate([
                'ugovor.sadrzaj' => 'required|string',
            ]);
            $validatedDataStavke = $request->validate([
                'stavke' => 'array|required',
                'stavke.*.id' => 'required|integer',
                'stavke.*.sadrzaj' => 'required|string',
            ]);
            $validatedDataDeletedStavke = $request->validate([
                'deletedStavke' => 'array',
                'deletedStavke.*.id' => 'required|integer',
            ]);
            $validateNoveStavke = $request->validate([
                'addedStavke' => 'array',
                'addedStavke.*.id' => 'required|integer',
                'addedStavke.*.ugovor_id' => 'required|integer',
                'addedStavke.*.sadrzaj' => 'required|string',
                'addedStavke.*.clan_id' => 'required|integer',
                'addedStavke.*.zakonik_id' => 'required|integer',

            ]);
            // Update Ugovor
            $ugovor = Ugovor::findOrFail($id);
            $ugovor->update(['sadrzaj' => $validatedDataUgovor['ugovor']['sadrzaj']]);
            foreach ($validatedDataStavke['stavke'] as $stavkaData) {
                Stavka_Ugovora::where('ugovor_id', $id)
                    ->where('id', $stavkaData['id'])
                    ->update(['sadrzaj' => $stavkaData['sadrzaj']]);
            }

            foreach ($validatedDataDeletedStavke['deletedStavke'] as $deletedStavkaData) {
                Stavka_Ugovora::where('ugovor_id', $id)
                    ->where('id', $deletedStavkaData['id'])
                    ->delete();
            }
            $noveStavkeData = [];
            foreach ($validateNoveStavke['addedStavke'] as $novaStavkaData) {
                $noveStavkeData[] = [
                    'id' => $novaStavkaData['id'],
                    'ugovor_id' => $novaStavkaData['ugovor_id'],
                    'sadrzaj' => $novaStavkaData['sadrzaj'],
                    'clan_id' => $novaStavkaData['clan_id'],
                    'zakonik_id' => $novaStavkaData['zakonik_id'],
                ];
            }
            Stavka_Ugovora::insert($noveStavkeData);
            DB::commit();
            // Vracam odgovor
            return response()->json(['message' => 'Ugovor i stavke su uspešno ažurirani'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['message' => 'Ugovor i stavke nisu azurirani'], 500);

        }
    }

}
<?php
  



use App\Http\Controllers\AdresaController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DrzavaController;
use App\Http\Controllers\GradController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\UgovorController;
use App\Http\Controllers\ZakonikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/adrese', [AdresaController::class, 'showAddressesInCity']);
// Route::get('/drzave', [DrzavaController::class, 'index']);
// Route::get('/gradovi', [GradController::class, 'gradoviOdDrzave']);
// Route::post('/kandidat', [KandidatController::class, 'kreirajKandidata']);
// Route::get('/kandidat', [KandidatController::class, 'prikaziKandidate']);
// Route::delete('/kandidat/{kandidat}', [KandidatController::class, 'deleteKandidat']);
// Route::get('/drzava/{drzavaid}', [DrzavaController::class, 'drzavaZaId']);
// Route::put('/kandidat/{id}', [KandidatController::class, 'update']);
// Route::get('/zakon', [ZakonikController::class, 'show']);
// Route::get('/clanZakona', [ZakonikController::class, 'clanoviZakona']);
// Route::post('/ugovor', [UgovorController::class, 'store']);
// Route::get('/ugovor', [UgovorController::class, 'show']);
// Route::delete('/ugovor', [UgovorController::class, 'storniraj']);
// Route::get('/pretraga', [UgovorController::class, 'pretrazi']);
// Route::get('/stavke', [UgovorController::class, 'prikaziStavke']);
// Route::put('/ugovor/{id}', [UgovorController::class, 'azuriraj']);
// Route::post('/register', [AuthController::class,'register']);
// Route::post('/login', [AuthController::class,'login']);

// Route::group( ['middleware' => ['auth:sanctum']],function(){

// });

// Route::middleware('auth:api')->group(function () {
//     Route::get('/protected-route', function () {
//         return response()->json(['message' => 'This is a protected route.']);
      
//     });
//     Route::post('/logout',[AuthController::class,'logout']);
// });

// Route::middleware('auth:api')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::middleware(['cors'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/adrese', [AdresaController::class, 'showAddressesInCity']);
Route::get('/drzave', [DrzavaController::class, 'index']);
Route::get('/gradovi', [GradController::class, 'gradoviOdDrzave']);
Route::post('/kandidat', [KandidatController::class, 'kreirajKandidata'])->middleware('checkUserRole');
Route::get('/kandidat', [KandidatController::class, 'prikaziKandidate'])->middleware('checkUserRole');
Route::delete('/kandidat/{kandidat}', [KandidatController::class, 'deleteKandidat'])->middleware('checkUserRole');
Route::get('/drzava/{drzavaid}', [DrzavaController::class, 'drzavaZaId']);
Route::put('/kandidat/{id}', [KandidatController::class, 'update'])->middleware('checkUserRole');
Route::get('/zakon', [ZakonikController::class, 'show']);
Route::get('/clanZakona', [ZakonikController::class, 'clanoviZakona']);
Route::post('/ugovor', [UgovorController::class, 'store']);
Route::get('/ugovor', [UgovorController::class, 'show']);
Route::delete('/ugovor', [UgovorController::class, 'storniraj']);
Route::get('/pretraga', [UgovorController::class, 'pretrazi']);
Route::get('/stavke', [UgovorController::class, 'prikaziStavke']);
Route::put('/ugovor/{id}', [UgovorController::class, 'azuriraj']);
Route::middleware(['auth:api'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
Route::middleware('jwt.verify')->group(function () {
    Route::post('/ugovor', [UgovorController::class, 'store']);
    Route::get('/ugovor', [UgovorController::class, 'show']);
    Route::delete('/ugovor', [UgovorController::class, 'storniraj']);
    Route::get('/pretraga', [UgovorController::class, 'pretrazi']);
    Route::get('/stavke', [UgovorController::class, 'prikaziStavke']);
    Route::put('/ugovor/{id}', [UgovorController::class, 'azuriraj']);
});

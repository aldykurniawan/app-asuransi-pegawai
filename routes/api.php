<?php

use App\Http\Controllers\API\AuthController;
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

// Route::get('/callapi', function() {
//     $url = 'https://api.goapi.id/v1/regional/kecamatan?kota_id=64.08';
//     $headers = [
//         'X-API-KEY' => '5cyCCYArZf1vmLMDrPSj3euiOzChxz'
//     ];
//     $client = new \GuzzleHttp\Client();
//     $response = $client->request('GET', $url, [
//         'headers' => $headers
//     ]);
//     $response = json_decode($response->getBody()->getContents(), true);
//     $kecamatan = $response['data'];
//     $urlkelurahan = 'https://api.goapi.id/v1/regional/kelurahan?kecamatan_id=';
//     foreach ($kecamatan as $key => $value) {
//         $response = $client->request('GET', $urlkelurahan.$value['id'], [
//             'headers' => $headers
//         ]);
//         $response = json_decode($response->getBody()->getContents(), true);
//         $kecamatan[$key]['kelurahan'] = $response['data'];
//     }
//     return $kecamatan;
// });

// profile user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load(['warga', 'warga.kelurahan', 'warga.kecamatan']);
});
// login
Route::post('/login', [AuthController::class, 'login']);
// register
Route::post('/register', [AuthController::class, 'register']);
// forgetPassword
Route::post('/forget-password', [AuthController::class, 'forgetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    // change-password
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    // changeProfile
    Route::post('/change-profile', [AuthController::class, 'changeProfile']);
    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

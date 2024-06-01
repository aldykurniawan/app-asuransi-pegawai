<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\Statik;

class IndexController extends Controller
{
    // index redirect to accounts/login
    public function index()
    {
        return redirect()->route('login');
    }

    /**
     * render API Statik Data
     * JSON response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiStatikData()
    {
        $data = Statik::where('slug', 'statik-kasir')->first();

        return response()->json($data->content);
    }
}

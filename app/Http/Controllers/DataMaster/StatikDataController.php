<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\Statik;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatikDataController extends Controller
{
    use FileHandler;

    public $routeName = 'eportal.statikegap';

    // show statik with slug egap
    public function showEgap()
    {
        $crumbs = [
            'Dashboard'   => route('dashboard'),
            'Data APP'    => '',
            'Statik Data' => '',
        ];

        $pageInfo = [
            'title' => 'Statik Data',
        ];

        // statik with slug statik-kasir

        $data = [
            'pageInfo'  => $pageInfo,
            'crumbs'    => $crumbs,
            'routeName' => $this->routeName,
        ];

        return Inertia::render('DataMaster/Statiks/Show', $data);
    }

    public function showEgapData()
    {
        $statik = Statik::slug('statik-kasir')->first();

        return $statik;
    }

    // store
    public function store(Request $request)
    {
        $statik = Statik::slug('statik-app')->first();

        $statik->update([
            'content' => $request->content,
        ]);

        return $statik;
    }
}

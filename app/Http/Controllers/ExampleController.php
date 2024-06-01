<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExampleRequest;
use App\Models\Example;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ExampleController extends Controller
{
    public $routeName = 'master.examples';

    /**
     * Display Page.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $crumbs = [
            'Dashboard'  => route('dashboard'),
            'Menu Utama' => '',
            'Example'    => '',
        ];

        $pageInfo = [
            'title' => 'Example',
        ];

        $perPage  = 10;
        $search   = $request->get('query');
        $mainData = Example::latest();

        if ($search) {
            $mainData = $mainData->where('nama', 'LIKE', '%'.$search.'%');
        }

        $mainData = $mainData
            ->paginate($perPage)
            ->withQueryString();

        $data = [
            'pageInfo'   => $pageInfo,
            'crumbs'     => $crumbs,
            'perPage'    => $perPage,
            'dataSource' => $mainData,
            'routeName'  => $this->routeName,
        ];

        return Inertia::render('Examples/Index', $data);
    }

    /**
     * Store Data.
     *
     * @param ExampleRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(ExampleRequest $request)
    {
        $validated = $request->validated();
        // created_by
        $validated['created_by'] = auth()->user()->id;
        Example::create($validated);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Get Data Edit.
     *
     * @param Example $example
     * @return Example|never
     */
    public function edit(Example $example)
    {
        return $example;
    }

    /**
     * Update Data.
     *
     * @param ExampleRequest $request
     * @param Example $example
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(ExampleRequest $request, Example $example)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $example) {
            // updated_by
            $validated['updated_by'] = auth()->user()->id;
            $example->update($validated);
        });

        session()->flash('success', 'Data Berhasil Diupdate');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Delete.
     *
     * @param  Example $example
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Example $example)
    {
        $example->delete();

        return redirect()->route($this->routeName.'.index');
    }
}

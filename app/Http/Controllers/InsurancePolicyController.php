<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsurancePolicyRequest;
use App\Models\InsurancePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InsurancePolicyController extends Controller
{
    public $routeName = 'asuransis';

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
            'Asuransi'   => '',
        ];

        $pageInfo = [
            'title' => 'Asuransi',
        ];

        $perPage  = 10;
        $search   = $request->get('query');
        $mainData = InsurancePolicy::latest();

        if ($search) {
            $mainData = $mainData->where('policy_number', 'LIKE', '%'.$search.'%')
                ->orWhere('policy_name', 'LIKE', '%'.$search.'%')
                ->orWhere('policy_type', 'LIKE', '%'.$search.'%')
                ->orWhere('start_date', 'LIKE', '%'.$search.'%')
                ->orWhere('end_date', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE', '%'.$search.'%');
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

        return Inertia::render('InsurancePolicys/Index', $data);
    }

    /**
     * Store Data.
     *
     * @param InsurancePolicyRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(InsurancePolicyRequest $request)
    {
        $validated = $request->validated();
        // created_by
        $validated['created_by'] = auth()->user()->id;
        InsurancePolicy::create($validated);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Get Data Edit.
     *
     * @param int $id
     * @return InsurancePolicy|never
     */
    public function edit($id)
    {
        $insurancePolicy = InsurancePolicy::findOrFail($id);

        return $insurancePolicy;
    }

    /**
     * Update Data.
     *
     * @param InsurancePolicyRequest $request
     * @param int $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(InsurancePolicyRequest $request, $id)
    {
        $validated       = $request->validated();
        $insurancePolicy = InsurancePolicy::findOrFail($id);

        DB::transaction(function () use ($validated, $insurancePolicy) {
            // updated_by
            $validated['updated_by'] = auth()->user()->id;
            $insurancePolicy->update($validated);
        });

        session()->flash('success', 'Data Berhasil Diupdate');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Delete.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $insurancePolicy = InsurancePolicy::findOrFail($id);
        $insurancePolicy->delete();

        return redirect()->route($this->routeName.'.index');
    }
}

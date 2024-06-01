<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\InsurancePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public $routeName = 'pegawais';

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
            'Employee'   => '',
        ];

        $pageInfo = [
            'title' => 'Pegawai',
        ];

        $perPage  = 10;
        $search   = $request->get('query');
        $mainData = Employee::latest();

        if ($search) {
            $mainData = $mainData->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->orWhere('address', 'LIKE', '%'.$search.'%');
        }

        $mainData = $mainData
            ->paginate($perPage)
            ->withQueryString();

        $data = [
            'pageInfo'      => $pageInfo,
            'crumbs'        => $crumbs,
            'perPage'       => $perPage,
            'dataSource'    => $mainData,
            'dataInsurance' => InsurancePolicy::get(),
            'routeName'     => $this->routeName,
        ];

        return Inertia::render('Employees/Index', $data);
    }

    /**
     * Store Data.
     *
     * @param EmployeeRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        // created_by
        $validated['created_by'] = auth()->user()->id;
        Employee::create($validated);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Get Data Edit.
     *
     * @param int $id
     * @return Employee|never
     */
    public function edit($id)
    {
        return Employee::find($id);
    }

    /**
     * Update Data.
     *
     * @param EmployeeRequest $request
     * @param int $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeRequest $request, $id)
    {
        $validated = $request->validated();
        $employee  = Employee::findOrFail($id);

        DB::transaction(function () use ($validated, $employee) {
            // updated_by
            $validated['updated_by'] = auth()->user()->id;
            $employee->update($validated);
        });

        session()->flash('success', 'Data Berhasil Diupdate');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Delete.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route($this->routeName.'.index');
    }
}

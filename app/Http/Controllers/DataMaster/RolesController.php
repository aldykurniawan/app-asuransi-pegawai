<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\RolesRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public $routeName = 'master.roles';

    /**
     * Display Page.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $crumbs = [
            'Dashboard'   => route('dashboard'),
            'Data Master' => '',
            'Roles'       => '',
        ];

        $pageInfo = [
            'title' => 'Roles',
        ];

        $perPage  = 10;
        $search   = $request->get('query');
        $mainData = Role::when($search, function ($qw, $search) {
            $qw->where('name', 'LIKE', '%'.$search.'%');
        })
        ->oldest()
        ->paginate($perPage)
        ->withQueryString();

        $data = [
            'pageInfo'   => $pageInfo,
            'crumbs'     => $crumbs,
            'perPage'    => $perPage,
            'dataSource' => $mainData,
            'routeName'  => $this->routeName,

        ];

        return Inertia::render('DataMaster/Roles/Index', $data);
    }

    /**
     * Store Data.
     *
     * @param RolesRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(RolesRequest $request)
    {
        $dataValidated = $request->validated();

        Role::create($dataValidated);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Get Data Edit.
     *
     * @param $id
     * @return Role|never
     */
    public function edit($id)
    {
        $roles = Role::find($id);
        if (request()->ajax()) {
            return $roles;
        }

        return abort(403);
    }

    /**
     * Update Data.
     *
     * @param RolesRequest $request
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(RolesRequest $request, $id)
    {
        $roles         = Role::find($id);
        $dataValidated = $request->validated();

        $roles->update($dataValidated);

        session()->flash('success', 'Data Berhasil Diupdate');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Delete.
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $roles = Role::find($id);
        $roles->delete();

        return redirect()->route($this->routeName.'.index');
    }
}

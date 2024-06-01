<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\UsersRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public $routeName = 'master.users';

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
            'Users'       => '',
        ];

        $pageInfo = [
            'title' => 'Users',
        ];

        $isSuperadmin = auth()->user()->hasRole(['superadmin']);

        $user = auth()->user();

        $perPage  = 10;
        $search   = $request->get('query');
        $mainData = User::where('id', '!=', 1)
        ->with(['permissions']);

        if ($search) {
            $mainData = $mainData->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('username', 'LIKE', '%'.$search.'%')
            ->orWhereHas('roles', function ($qw) use ($search) {
                $qw->where('name', '!=', 'superadmin');
                $qw->where('name', 'LIKE', '%'.$search.'%');
            });
        }

        $mainData = $mainData->whereHas('roles', function ($qw) use ($user) {
            // $qw->whereNotIn('name', ['']);
            // where not $user->id
            $qw->whereNotIn('id', [$user->id]);
        });

        $mainData = $mainData->oldest()
        ->paginate($perPage)
        ->withQueryString();

        $dataRole = Role::when(! $isSuperadmin, function ($query) {
            $query->whereNotIn('name', ['superadmin']);
        })->when($isSuperadmin, function ($query) {
            // $query->whereNotIn('name', ['']);
        })
        ->orderBy('id', 'asc')->get();

        $data = [
            'pageInfo'   => $pageInfo,
            'crumbs'     => $crumbs,
            'perPage'    => $perPage,
            'dataSource' => $mainData,
            'routeName'  => $this->routeName,
            'dataRole'   => $dataRole,
            // 'dataPermission' => Permission::get(),

        ];

        return Inertia::render('DataMaster/Users/Index', $data);
    }

    /**
     * Store Data.
     *
     * @param UsersRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request)
    {
        $request->validated();

        $dataValidated['email_verified_at'] = Carbon::now();
        $dataValidated['password']          = Hash::make($request->password);

        $dataValidated = [
            'name'              => $request->name,
            'username'          => $request->username,
            'email'             => $request->email,
            'hp'                => $request->hp,
            'is_active'         => 1,
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make($request->password),
        ];

        $user = User::create($dataValidated);
        $user->assignRole($request->role);
        $user->givePermissionTo($request->permission);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Get Data Edit.
     *
     * @param User $user
     * @return User|never
     */
    public function edit(User $user)
    {
        return $user->load(['roles', 'permissions']);
    }

    /**
     * Update Data.
     *
     * @param UsersRequest $request
     * @param User $user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UsersRequest $request, User $user)
    {
        $request->validated();
        DB::transaction(function () use ($request, $user) {
            if ($request->password != '') {
                $request->validate([
                    'password' => 'required|min:3|confirmed',
                ]);
                $dataValidated['password'] = Hash::make($request->password);
            }

            $dataValidated = [
                'name'     => $request->name,
                'username' => $request->username,
                'email'    => $request->email,
                'hp'       => $request->hp,
            ];

            $user->update($dataValidated);
            $user->roles()->detach();
            $user->assignRole($request->role);
            $user->syncPermissions($request->permission);
        });

        session()->flash('success', 'Data Berhasil Diupdate');

        return redirect()->route($this->routeName.'.index');
    }

    /**
     * Delete.
     *
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route($this->routeName.'.index');
    }
}

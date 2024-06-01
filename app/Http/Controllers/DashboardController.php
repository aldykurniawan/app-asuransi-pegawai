<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends BackendController
{
    public function index()
    {
        $this->readNotif(request()->url());

        // if (auth()->user()->hasRole(['superadmin', 'admin'])) {
        // }
        return $this->dashboardAdmin();
    }

    /**
     * render dashboard admin.
     *
     * @return \Inertia\Response
     */
    private function dashboardAdmin()
    {
        $crumbs = [
            'Dashboard' => route('dashboard'),
        ];

        $pageInfo = [
            'title' => 'Dashboard',
        ];

        $data = [
            'pageInfo' => $pageInfo,
            'crumbs'   => $crumbs,
        ];

        return Inertia::render('Dashboard/Admin', $data);
    }
}

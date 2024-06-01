<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class NotificationController extends Controller
{
    // markAsRead
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            // return url
            return redirect()->to($notification->data['url']);
        }
        // redirect to dashboard
        return redirect()->route('dashboard');
    }

    /**
     * render all notif.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $crumbs = [
            'Dashboard' => route('dashboard'),
        ];

        $pageInfo = [
            'title' => 'Dashboard',
        ];

        $data = [
            'pageInfo'      => $pageInfo,
            'crumbs'        => $crumbs,
            'notifications' => auth()->user()->notifications,
        ];

        return Inertia::render('Notifications', $data);
    }

    /**
     * get data unread notification.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserNotification()
    {
        if (request()->ajax()) {
            $user = auth()->user();

            return response()->json($user->unreadNotifications, 200);
        }

        return response()->json('error', 500);
    }
}

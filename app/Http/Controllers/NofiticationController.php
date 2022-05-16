<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NofiticationController extends Controller
{
    public function index(): View
    {
        $notifications = Auth::user()->notifications()->get();
        return view('notifications.index', compact('notifications'));
    }

    public function read(string $notification): RedirectResponse
    {
        Auth::user()
            ->unreadNotifications()
            ->where('id', $notification)
            ->update(['read_at' => now()]);

        return back();
    }

    public function readAll(): RedirectResponse
    {
        Auth::user()
            ->unreadNotifications()
            ->update(['read_at' => now()]);

        return redirect()->route('welcome');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        if (Auth::user()->role === 'admin'){
            return view('dashboard/admin-dashboard');
        }
        return view('dashboard/user-dashboard');
    }
}

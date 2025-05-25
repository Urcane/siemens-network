<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Dashboard";
        return view('home', compact('homepage'));
    }

    public function indexWrite(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Dashboard";
        return view('dashboard.dashboard-write', compact('homepage'));
    }

    public function indexPing(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Dashboard";
        return view('dashboard.command.ping', compact('homepage'));
    }

    public function indexNmap(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Dashboard";
        return view('dashboard.command.nmap', compact('homepage'));
    }

    public function indexFlood(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Dashboard";
        return view('dashboard.command.flood', compact('homepage'));
    }
}

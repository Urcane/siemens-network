<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Modbus Read";
        return view('home', compact('homepage'));
    }

    public function indexWrite(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Modbus Write";
        return view('dashboard.dashboard-write', compact('homepage'));
    }

    public function indexTcpdump(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "TCP Dump";
        return view('dashboard.dashboard-tcpdump', compact('homepage'));
    }

    public function indexPing(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Ping";
        return view('dashboard.command.ping', compact('homepage'));
    }

    public function indexNmap(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Port Scan";
        return view('dashboard.command.nmap', compact('homepage'));
    }

    public function indexIcmp(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "ICMP Scan";
        return view('dashboard.command.icmp', compact('homepage'));
    }

    public function indexFlood(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "Flood";
        return view('dashboard.command.flood', compact('homepage'));
    }

    public function indexDdos(Request $request)
    {
        $user_id = auth()->user()->id;
        $homepage = "DDOS DNS";
        return view('dashboard.command.ddos', compact('homepage'));
    }
}

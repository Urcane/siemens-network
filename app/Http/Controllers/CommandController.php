<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class CommandController extends Controller
{
    public function publishPing(Request $request)
    {
        $validated = $request->validate([
            'mode' => 'required|boolean',
            'ip' => 'nullable',
        ]);

        $data = [
            'mode' => $validated['mode'] ? 'start' : 'stop',
            'ip' => $validated['ip'],
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('ping/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }

    public function publishNmap(Request $request)
    {
        $validated = $request->validate([
            'mode' => 'required|boolean',
            'ip' => 'required',
            'top_ports' => 'nullable',
        ]);

        $data = [
            'mode' => $validated['mode'] ? 'start' : 'stop',
            'ip' => $validated['ip'],
            'top_ports' => $validated['top_ports'],
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('nmap/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }

    public function publishFlood(Request $request)
    {
        $validated = $request->validate([
            'mode' => 'required|boolean',
            'ip' => 'required',
            'port' => 'nullable',
        ]);

        $data = [
            'mode' => $validated['mode'] ? 'start' : 'stop',
            'ip' => $validated['ip'],
            'port' => $validated['port'] ?? null,
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('flood/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }
}

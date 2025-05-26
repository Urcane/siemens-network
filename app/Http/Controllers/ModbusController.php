<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class ModbusController extends Controller
{
    public function publishRead(Request $request)
    {
        $validated = $request->validate([
            'ip_address' => 'required',
            'port' => 'required|integer',
            'address' => 'required|integer',
            'quantity' => 'required|integer',
            'fc' => 'required|integer',
            'device_id' => 'required|integer',
        ]);

        $data = [
            "ip_address" => $validated['ip_address'],
            "port" => $validated['port'],
            'fc' => $validated['fc'],
            'unitId' => $validated['device_id'],
            'address' => $validated['address'],
            'quantity' => $validated['quantity'],
        ];

        $mqtt = MQTT::connection('default3');
        $mqtt->publish('modbus/read/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }

    public function publishWrite(Request $request)
    {
        $validated = $request->validate([
            'ip_address' => 'required',
            'port' => 'required|integer',
            'address' => 'required|integer',
            'device_id' => 'required|integer',
            'value' => 'required|integer',
        ]);

        $data = [
            'ip_address' => $validated['ip_address'],
            'port' => $validated['port'],
            'unitId' => $validated['device_id'],
            'fc' => 16,
            'address' => $validated['address'],
            'quantity' => 1,
            'values' => $validated['value'],
        ];


        $mqtt = MQTT::connection('default3');
        $mqtt->publish('modbus/write/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }

    public function publishTcpdump(Request $request)
    {
        $validated = $request->validate([
            'mode' => 'required|boolean',
            'port' => 'required|integer',
        ]);

        $data = [
            "mode" => $validated['mode'] ? 'start' : 'stop',
            "interface" => 'eth0',
            "port" => $validated['port'],
        ];

        $mqtt = MQTT::connection('default3');
        $mqtt->publish('modbus/tcpdump/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class ModbusController extends Controller
{
    public function publishRead(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|integer',
            'quantity' => 'required|integer',
            // 'function_code' => 'required|integer',
            'device_id' => 'required|integer',
        ]);

        $data = [
            'fc' => 3,
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
            'address' => 'required|integer',
            'device_id' => 'required|integer',
            'value' => 'required|integer'
        ]);

        $data = [
            'fc' => 16,
            'value' => [$validated['value']],
            'unitId' => $validated['device_id'],
            'address' => $validated['address'],
            'quantity' => 1,
        ];

        $mqtt = MQTT::connection('default3');
        $mqtt->publish('modbus/write/input', json_encode($data), 0);

        return response()->json(['success' => true]);
    }
}

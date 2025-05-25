<?php

namespace App\Console\Commands;

use App\Events\FloodOutput;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Events\ModbusOutputReceived;
use App\Events\ModbusOutputWrite;
use App\Events\NmapOutput;
use App\Events\PingOutput;
use Illuminate\Support\Facades\Log;

class MqttConsoleBridge extends Command
{
    protected $signature = 'mqtt:console';
    protected $description = 'Stream MQTT topic to WebSocket';

    public function handle()
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->subscribe('modbus/read/output', function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
                event(new ModbusOutputReceived($message));
            }, 1);

            $mqtt->subscribe('modbus/write/output', function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
                event(new ModbusOutputWrite($message));
            }, 1);

            $mqtt->subscribe('ping/output/msg', function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
                event(new PingOutput($message));
            }, 1);

            $mqtt->subscribe('nmap/output/msg', function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
                event(new NmapOutput($message));
            }, 1);

            $mqtt->subscribe('flood/output/msg', function (string $topic, string $message) {
                echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
                event(new FloodOutput($message));
            }, 1);
            $mqtt->loop(true);

            // return 0;
        } catch (\Throwable $th) {
            Log::error($th);
            echo sprintf('Error: %s:', $th);
        }
    }
}

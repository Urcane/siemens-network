<?php

namespace App\Console\Commands;

use App\Events\DdosOutput;
use App\Events\DdosOutputError;
use App\Events\FloodOutput;
use App\Events\FloodOutputError;
use App\Events\IcmpOutput;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Events\ModbusOutputReceived;
use App\Events\ModbusOutputWrite;
use App\Events\ModbusTcpdumpOutput;
use App\Events\NmapOutput;
use App\Events\PingOutput;
use App\Events\StatusFlood;
use App\Events\StatusModbus;
use App\Events\StatusNmap;
use App\Events\StatusPing;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttConsoleBridge extends Command
{
    protected $signature = 'mqtt:console';
    protected $description = 'Stream MQTT topic to WebSocket';

    public function handle()
    {
        $subscriptions = [
            'modbus/read/output' => ModbusOutputReceived::class,
            'modbus/write/output' => ModbusOutputWrite::class,
            'ping/output/msg' => PingOutput::class,
            'nmap/output/msg' => NmapOutput::class,
            'icmp/output/msg' => IcmpOutput::class,
            'flood/output/msg' => FloodOutput::class,
            'flood/output/error' => FloodOutputError::class,
            'ddos/output/msg' => DdosOutput::class,
            'ddos/output/error' => DdosOutputError::class,
            'modbus/tcpdump/output' => ModbusTcpdumpOutput::class,
            'status/ping' => StatusPing::class,
            'status/flood' => StatusFlood::class,
            'status/nmap' => StatusNmap::class,
            'status/modbus' => StatusModbus::class,
            'status/icmp' => StatusModbus::class,
            'status/ddos' => StatusModbus::class,
        ];

        while (true) {
            try {
                $mqtt = MQTT::connection();

                foreach ($subscriptions as $topic => $eventClass) {
                    $mqtt->subscribe($topic, function (string $topic, string $message) use ($eventClass) {
                        echo sprintf('[%s] %s' . PHP_EOL, $topic, $message);
                        event(new $eventClass($message));
                    }, 1);
                }

                echo "✅ MQTT Connected & Subscribed" . PHP_EOL;

                $mqtt->loop(true); // Will block here until error
            } catch (MqttClientException $e) {
                echo "⚠️ MQTT Error: " . $e->getMessage() . PHP_EOL;
                // Optionally log with Laravel:
                Log::error('MQTT crashed', ['error' => $e->getMessage()]);
            } catch (\Throwable $e) {
                echo "🔥 Unexpected error: " . $e->getMessage() . PHP_EOL;
            }

            // Wait before retrying (avoid rapid reconnect loops)
            echo "🔁 Reconnecting in 5 seconds..." . PHP_EOL;
            sleep(5);
        }
    }
}

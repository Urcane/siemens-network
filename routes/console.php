<?php

use App\Jobs\DownAlertJob;
use App\Notifications\DownAlertNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('telegram:chat-id', function(){
 
    // Response is an array of updates.
    $updates = NotificationChannels\Telegram\TelegramUpdates::create()
      ->limit(2)
      ->options([
          'timeout' => 0,
      ])
      ->get();
 
    if($updates['ok']) {
        $chatId = $updates['result'][0]['message']['chat']['id'];
    }
 
    $this->comment($chatId);
});

Artisan::command('telegram:send-notif', function(){
    // My Channel
    DownAlertJob::dispatch();
});


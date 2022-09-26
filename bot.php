<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
use Discord\Parts\User\Activity;
use React\Http\Browser;
include __DIR__.'/vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';



$loop = Factory::create();

$browser = new Browser($loop);

$discord = new Discord([
    'token' => 'MTAyMzg0NzM1MzI3NjQ0ODc5MA.GFZj1w.a9Duq42aAJBrhbwDpGJSxK6XctMilnjF4sykyQ',
    'loop' => $loop,
]);

$discord->on('ready', function($discord) {
   $activity = $discord->factory(\Discord\Parts\User\Activity::class, [
       'name' => '?help',
       'type' => Activity::TYPE_LISTENING
   ]);
   $discord->updatePresence($activity);
});


$discord->on('message', function (Message $message, Discord $discord) {
    
    if (strtolower($message->content) == '?status') {
            $test = 'Läuft, Chef!';
            $message->reply($test);
    }
    if (strtolower($message->content) == '?help') {
            $test = 'Der gewünschte Gesprächsteilnehmer ist zurzeit leider nicht erreichbar kek';
            $message->reply($test);
    }
    if (strtolower($message->content) == '!ballern') {
        $array = file("commands/ballern/druffisprueche.txt");
        shuffle($array);
        $spruch=$array[0];
        $message->reply($spruch);

    }


});

$discord->run();
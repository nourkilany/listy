<?php

use BotMan\BotMan\BotMan;
use App\Http\Controllers\ItemController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('/start', ItemController::class.'@start');
$botman->hears('/start@OurListyBot', ItemController::class.'@start');

$botman->hears('stop', function(BotMan $bot) {
    $bot->reply('stopped');
})->stopsConversation();

$botman->fallback('App\Http\Controllers\FallbackController@index');
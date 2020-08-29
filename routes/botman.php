<?php
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ItemController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('/start', ItemController::class.'@start');
$botman->hears('/start@OurListyBot', ItemController::class.'@start');

$botman->hears('stop', function(BotMan $bot) {
    $bot->reply('stopped');
})->stopsConversation();

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->fallback('App\Http\Controllers\FallbackController@index');
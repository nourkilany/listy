<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class FallbackController extends Controller
{
    /**
     * Respond with a generic message.
     *
     * @param  Botman  $bot
     * @return void
     */
    public function index($bot)
    {
        $bot->reply('Sorry, I did not understand this command: ' .$bot->getMessage()->getText());
    }
}

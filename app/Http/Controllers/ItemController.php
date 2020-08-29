<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\EntryConversation;

class ItemController extends Controller
{
    /**
     * @param  Botman  $bot
     */
    public function start($bot)
    {
        $bot->startConversation(new EntryConversation());
    }
}

<?php

namespace App\Http\Controllers;

use App\Conversations\EntryConversation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

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

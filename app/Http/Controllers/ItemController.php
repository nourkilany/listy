<?php

namespace App\Http\Controllers;

use App\Conversations\CategoryConversation;
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

    /**
     * @param  BotMan  $bot
     */
    public function category($bot)
    {
        $bot->startConversation(new CategoryConversation());
    }
}

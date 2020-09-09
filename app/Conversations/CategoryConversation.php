<?php

namespace App\Conversations;

use App\Category;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\DB;
use function foo\func;

class CategoryConversation extends Conversation
{
    public function run()
    {

        $this->ask('Write the name of the category you want to add', function (Answer $answer) {
            DB::table('categories')->insert([
                'name' => trim($answer->getText())
            ]);
            $this->say('Category created successfully');
        });
    }
}

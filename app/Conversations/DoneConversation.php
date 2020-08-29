<?php

namespace App\Conversations;

use App\Category;
use Illuminate\Support\Facades\DB;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class DoneConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return void
     */
    public function run()
    {
        $this->askDone();
    }

    public function askDone()
    {

        $str = 'write the number of the item you want to mark done ✅️'.PHP_EOL;

        foreach (Category::all() as $category) {
            $items = $category->items()->get();
            $str .= ucfirst($category->name).' :'.PHP_EOL;
            foreach ($items as $item) {
                if ($item->done) {
                    continue;
                }

                $str .= (string) $item->id.'- '.$item->title.PHP_EOL;
            }
            $str .= PHP_EOL;
        }

        $this->ask($str, function (Answer $answer) {
            $item_id = (int) $answer->getText();

            DB::table('items')->where('id', $item_id)->update(['done' => true]);

            $this->say('Item was marked as done successfully');
        });
    }
}

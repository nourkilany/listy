<?php

namespace App\Conversations;

use App\Category;
use Illuminate\Support\Facades\DB;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class RemoveConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return void
     */
    public function run()
    {
        $this->askremove();
    }

    public function askRemove()
    {

        $str = 'write the number of the item you want to remove ⛔️⛔️'.PHP_EOL;

        foreach (Category::all() as $category) {
            $items = $category->items()->get();
            $str .= ucfirst($category->name).' :'.PHP_EOL;
            foreach ($items as $item) {
                $str .= (string) $item->id.'- '.$item->title.PHP_EOL;
            }
            $str .= PHP_EOL;
        }

        $this->ask($str, function (Answer $answer) {
            $item_id = (int) $answer->getText();

            DB::table('items')->where('id', '=', (int) $item_id)->delete();

            $this->say('Item was deleted successfully');
        });
    }
}

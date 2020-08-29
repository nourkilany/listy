<?php

namespace App\Conversations;

use App\Category;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ViewConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return void
     */
    public function run()
    {
        $str = '';

        foreach (Category::all() as $category) {
            $items = $category->items()->get();
            $str .= $category->name.' :'.PHP_EOL.PHP_EOL;
            foreach ($items as $item) {
                if ($item->done) {
                    $str .= '- <s>'.$item->title.'</s>'.PHP_EOL;
                } else {
                    $str .= '- '.$item->title.PHP_EOL;
                }
            }
            $str .= PHP_EOL;
        }


        $this->say($str, ['parse_mode' => 'HTML']);
    }
}

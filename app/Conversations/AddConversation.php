<?php

namespace App\Conversations;

use App\Category;
use App\Item;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\DB;

class AddConversation extends Conversation
{
    protected $category;

    /**
     * Start the conversation.
     *
     * @return void
     */
    public function run()
    {
        $this->askAdd();
    }

    public function askAdd()
    {
        $categoriesButtons = Category::all()
            ->map(function ($category) {
                return Button::create(ucfirst($category->name))->value($category->id);
            })->toArray();

        $question = Question::create('Choose a category')
            ->fallback('unable to ask question')
            ->callbackId('ask_add')
            ->addButtons($categoriesButtons);

        $this->ask($question, function (Answer $answer) {
            $this->category = $answer->getValue();

            $this->askItem();
        });
    }

    public function askItem()
    {
        $this->ask('Now write your item', function(Answer $answer) {
            $item = $answer->getText();

            DB::table('items')->insert(
                [
                    'category_id' => $this->category,
                    'title' => $item
                ]
            );

            $this->say('Great - that is all we need');
        });
    }
}

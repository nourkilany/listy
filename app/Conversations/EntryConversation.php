<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class EntryConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return void
     */
    public function run()
    {
        $this->askWhatToDo();
    }

    public function askWhatToDo()
    {
        $question = Question::create("What do you want ?")
            ->fallback('unable to ask question')
            ->callbackId('ask_what_to_do')
            ->addButtons([
                Button::create('Add')->value('Add'),
                Button::create('Remove')->value('Remove'),
                Button::create('Mark as done')->value('Done'),
                Button::create('View')->value('View'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $conversationMapper = [
                'Add' => new AddConversation(),
                'Remove' => new RemoveConversation(),
                'Done' => new DoneConversation(),
                'View' => new ViewConversation()
            ];

            $value = $answer->getValue();

            $this->bot->startConversation($conversationMapper[$value]);
        });
    }
}

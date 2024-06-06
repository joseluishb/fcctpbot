<?php

namespace App\Http\Conversations;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class SearchingStudentConversation extends Conversation
{

    /**
     */
    public function run(): void
    {
        $this->ask('Como te llamas?', function (Answer $answer) {
            $this->say('Hola, ' . $answer->getText());
        });
    }
}

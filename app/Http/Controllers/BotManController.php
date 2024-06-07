<?php

namespace App\Http\Controllers;

use App\Http\Conversations\SearchingStudentConversation;
use App\Http\Conversations\SelectingDocTypeConversation;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('start_conversation', function (BotMan $bot) {
            $bot->startConversation(new SelectingDocTypeConversation());
        });

        $botman->fallback(function ($bot) {
            $bot->reply('Pucha, No me han programado para entender tu mensaje');
        });

        $botman->hears('Hola', function (BotMan $bot) {
            $bot->reply('Hola xixo(a)');

            $bot->ask('Como te llamas?', function (Answer $answer, Conversation $bot) {
                $bot->say('Encantado de conocerte, ' . $answer->getText());
            });
        });

        $botman->hears('Soy alumno', function (BotMan $bot) {
            $bot->startConversation(new SearchingStudentConversation());
        });

        $botman->hears('Mi doc', function (BotMan $bot) {
            $bot->startConversation(new SelectingDocTypeConversation());
        });

        $botman->listen();
    }
}

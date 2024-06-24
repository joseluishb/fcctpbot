<?php

namespace App\Http\Controllers;

use App\Http\Conversations\SearchingStudentConversation;
use App\Http\Conversations\SelectingDocTypeConversation;
use App\Services\ConditionEvaluatorService;
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
            $conditionEvaluatorService = new ConditionEvaluatorService();
            $bot->startConversation(new SelectingDocTypeConversation($conditionEvaluatorService, $bot));
        });


        $botman->hears('hola', function (BotMan $bot) {
            $bot->reply('Hola, cuéntame, ¿en qué te ayudo?');
        });

        $botman->hears('gracias', function (BotMan $bot) {
            $bot->reply('Siempre estaré aquí para tus consultas 🙌.');
        });

        $botman->hears('Soy alumno', function (BotMan $bot) {
            $bot->startConversation(new SearchingStudentConversation());
        });

        // $botman->hears('(.*)', function (BotMan $bot) {
        //     $bot->startConversation(new SelectingDocTypeConversation());
        // });

        $botman->fallback(function (BotMan $bot) {
            //$bot->reply('Pucha, No me han programado para entender tu mensaje');
            $conditionEvaluatorService = new ConditionEvaluatorService();
            $bot->startConversation(new SelectingDocTypeConversation($conditionEvaluatorService, $bot));
        });


        $botman->listen();
    }
}

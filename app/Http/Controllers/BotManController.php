<?php

namespace App\Http\Controllers;

use App\Http\Conversations\SearchingStudentConversation;
use App\Http\Conversations\SelectingDocTypeConversation;
use App\Models\SapM\TempMatricula;
use App\Services\ConditionEvaluatorService;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

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

        $botman->hears('{message}', function (BotMan $bot, $message) {
            //$bot->reply('Lorem ipsummm!!!');
            $response = $this->sendToDialogflow($message);
            $bot->reply($response);

        });

        // $botman->hears('{message}', function (BotMan $botman, $message) {
        //     $response = $this->sendToDialogflow($message);
        //     $botman->reply($response);
        // });

        $botman->fallback(function (BotMan $bot) {
            $userMessage = $bot->getMessage()->getText();

            //$bot->reply('Pucha, No me han programado para entender tu mensaje');
            $conditionEvaluatorService = new ConditionEvaluatorService();
            $conversation = new SelectingDocTypeConversation($conditionEvaluatorService, $bot);

            $conversation->initializeSessionId();
            $conversation->startSession();

            $conversation->logInteraction('initial_message', null, $userMessage);

            $bot->startConversation($conversation);


        });


        $botman->listen();
    }

    public function getTurnoMatricula(Request $request)
    {
        $nroDoc = trim($request->input('dni'));

        $tmpMatr = TempMatricula::where('dni', $nroDoc)->first();
        $msge = null;

        $status = "NotFounded";
        if($tmpMatr) {
            $status = "Founded";

            $formatDatetime = Carbon::parse($tmpMatr->fec_mat)->format('d/m/Y \a \l\a\s H:i');
            $msge = 'Podrás realizar tu matrícula a partir del ' . $formatDatetime;
        }



        return response()->json([
            'status' => $status,
            'msge' => $msge
        ]);
    }

    protected function sendToDialogflow($message)
    {
        // Realiza una solicitud HTTP al controlador DialogflowController
        try {
            $ngrokUrl = 'https://47dd-2001-1388-13a6-9229-a15a-b305-555d-b0b3.ngrok-free.app/dialogflow/detect-intent';

            $response = Http::post($ngrokUrl, [
                'text' => $message,
            ]);

            // Verifica si la respuesta fue exitosa
            if ($response->successful()) {
                // Obtén el texto de la respuesta de Dialogflow
                $fulfillmentText = $response->json('fulfillmentText');

                return $fulfillmentText;
            } else {
                return "Hubo un problema al procesar tu solicitud. Inténtalo nuevamente.";
            }
        } catch (\Exception $e) {
            return "Ocurrió un error: " . $e->getMessage();
        }
    }
}

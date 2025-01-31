<?php

namespace App\Services;

use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Illuminate\Support\Facades\Log;

class DialogflowService
{
    public function gettingIntent($message)
    {
/*         Log::info('GOOGLE_APPLICATION_CREDENTIALS: ' . env('GOOGLE_APPLICATION_CREDENTIALS'));

        if (file_exists(env('GOOGLE_APPLICATION_CREDENTIALS'))) {
            Log::info('JSON file is accessible.');
        } else {
            Log::error('JSON file is not accessible.');
        } */

        $sessionsClient = null;

        try {
            $projectId = 'fcctp-agent-matr-pgqo'; // Reemplaza con tu ID de proyecto
            $sessionId = uniqid(); // Puedes generar un ID de sesión único
            $languageCode = 'es'; // Idioma del usuario

            // Crea el cliente de sesiones
            $sessionsClient = new SessionsClient();
            // Configura la sesión
            $session = $sessionsClient->sessionName($projectId, $sessionId);

            // Crea el input de texto
            $textInput = new TextInput();
            $textInput->setText($message);
            $textInput->setLanguageCode($languageCode);

            // Configura la consulta
            $queryInput = new QueryInput();
            $queryInput->setText($textInput);

            // Detecta la intención
            $response = $sessionsClient->detectIntent($session, $queryInput);
            $queryResult = $response->getQueryResult();
            $fulfillmentText = $queryResult->getFulfillmentText();
            $intentName = $queryResult->getIntent()->getDisplayName();

            Log::info('Botman fulfillmentText: ' . $fulfillmentText);
            Log::info('Dialogflow IntentName: ' . $intentName);


            return $intentName;
            /*return response()->json([
                'fulfillmentText' => $fulfillmentText,
                'intentName' => $intentName,
            ]);*/

        } catch (\Exception $e) {
            Log::error('Error detecting intent: ' . $e->getMessage());
            return $e->getMessage();
        } finally {
            //$sessionsClient->close();
            if ($sessionsClient) {
                $sessionsClient->close();
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Illuminate\Support\Facades\Log;

class DialogflowController extends Controller
{
    public function detectIntent(Request $request)
    {
        // Obtén el texto del usuario desde la solicitud
        $text = $request->input('text');
        Log::info($request);
        $projectId = 'fcctp-agent-matr-pgqo'; // Reemplaza con tu ID de proyecto
        $sessionId = uniqid(); // Puedes generar un ID de sesión único
        $languageCode = 'es'; // Idioma del usuario

        // Crea el cliente de sesiones
        $sessionsClient = new SessionsClient();

        try {
            // Configura la sesión
            $session = $sessionsClient->sessionName($projectId, $sessionId);
            // Crea el input de texto
            $textInput = new TextInput();
            $textInput->setText($text);
            $textInput->setLanguageCode($languageCode);
            // Configura la consulta
            $queryInput = new QueryInput();
            $queryInput->setText($textInput);
            // Detecta la intención
            $response = $sessionsClient->detectIntent($session, $queryInput);
            $queryResult = $response->getQueryResult();
            $fulfillmentText = $queryResult->getFulfillmentText();

            return response()->json([
                'fulfillmentText' => $fulfillmentText,
            ]);

        } catch (\Exception $e) {
            Log::error('Error detecting intent: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error detecting intent'
            ], 500);
        } finally {
            $sessionsClient->close();
        }
    }

    public function hola()
    {
        return response()->json([
            'hola' => 'Hola'
        ]);
    }
}

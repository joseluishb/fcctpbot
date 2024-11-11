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
        // Log::info('Request: ' . $request);
        // return;

        // Verifica si la solicitud proviene de Dialogflow y maneja la respuesta directamente

        /*
        if ($request->has('queryResult')) {
            // Obtiene el texto del usuario y otros detalles desde Dialogflow
            $text = $request->input('queryResult.queryText');
            $intentName = $request->input('queryResult.intent.displayName');
            $fulfillmentText = $request->input('queryResult.fulfillmentText');

            Log::info('Texto recibido desde Dialogflow: ' . $text);
            Log::info('Intent detectado: ' . $intentName);
            Log::info('Dialogflow fulfillmentText: ' . $fulfillmentText);

            // Si `fulfillmentText` no está vacío, lo devuelve; si no, devuelve un mensaje por defecto
            return response()->json([
                'fulfillmentText' => $fulfillmentText ?? 'No se encontraron respuestas adecuadas para tu solicitud.',
            ]);
        }
        */

        try {
            // Si la solicitud no es de Dialogflow, se asume que es de Botman o desde otra fuente
            $text = $request->input('text');
            Log::info('Texto recibido desde Botman: ' . $text);


            $projectId = 'fcctp-agent-matr-pgqo'; // Reemplaza con tu ID de proyecto
            $sessionId = uniqid(); // Puedes generar un ID de sesión único
            $languageCode = 'es'; // Idioma del usuario

            // Crea el cliente de sesiones
            $sessionsClient = new SessionsClient();
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

            Log::info('Botman fulfillmentText: ' . $fulfillmentText);
            Log::info('Dialogflow IntentName: ' . $queryResult->getIntent()->getDisplayName());


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

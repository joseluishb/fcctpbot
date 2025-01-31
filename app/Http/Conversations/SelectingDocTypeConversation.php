<?php

namespace App\Http\Conversations;

use App\Models\BotInteraction;
use App\Models\BotSession;
use App\Models\MenuOption;
use App\Models\SapM\Cliente;
use App\Services\ConditionEvaluatorService;
use App\Services\DialogflowService;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;


class SelectingDocTypeConversation extends Conversation
{

    protected $botman;
    protected $documentType;
    protected $conditionEvaluator;
    protected $sessionId;
    public $uuid;
    protected $botSessionId;
    protected $dialogflow;


    public function __construct(ConditionEvaluatorService $conditionEvaluator, $botman, DialogflowService $dialogflow)
    {
        $this->conditionEvaluator = $conditionEvaluator;
        $this->botman = $botman;
        $this->dialogflow = $dialogflow;
    }

    /**
     */
    public function run() : void
    {
        $this->initializeSessionId();
/*         Log::info('sessions in __construct', [
            'sessionId' => $this->sessionId,
            'session_uuid' => $this->uuid,
            'uuid' => $this->botman->userStorage()->get('session_uuid')
        ]); */



        $startMessage = $this->botman->getMessage()->getText();
        $this->botman->userStorage()->save([
            'startMessage' => $startMessage
        ]);

        # Log::info("startMessage:" . $startMessage);

        $this->startSession();

        $this->bot->typesAndWaits(1);

        //$this->askForDocumentType();

        $documentNumber = $this->botman->userStorage()->get('documentNumber');
        Log::info("doc_number entered:" . $documentNumber);

        if(!$documentNumber) {
            $this->askForDocumentNumber();
        }else{
            $this->conversationIntent();
        }
    }

    public function askForDocumentType()
    {
        $question = Question::create('Antes de ayudarte, señala tu tipo de documento por favor')
            ->fallback('No puedo ayudarte con eso')
            ->callbackId('ask_document_type')
            ->addButtons([
                Button::create('DNI')->value('dni'),
                Button::create('CE')->value('ce'),
            ]);



        $this->ask($question, function (Answer $answer) {
            $this->bot->typesAndWaits(1);

            $this->logInteraction('document_type_enter', null, $answer->getValue());

            if ($answer->isInteractiveMessageReply()) {
                $this->documentType = $answer->getValue();
                $this->askForDocumentNumber();
            } else {
                $this->repeat('Por favor selecciona una opción válida.');
            }
        });
    }

    public function askForDocumentNumber()
    {
        //$documentText = $this->documentType === 'dni' ? 'Ingresa tu DNI' : 'Ingresa tu CE';
        $documentText = 'Antes de ayudarte, ingresa tu DNI ó tu CE, por favor:';

        $this->bot->typesAndWaits(1);

        $this->ask($documentText, function (Answer $answer) {

            $documentNumber = $answer->getText();
            $this->bot->typesAndWaits(1);

            $this->sessionWithDocNumber($documentNumber);

            if ($this->validateDocumentNumber($documentNumber)) {

                $this->botman->userStorage()->save([
                    'documentNumber' => $documentNumber
                ]);
                $clienteTempMat = $this->conditionEvaluator->getClienteTempMatricula($documentNumber);

                if($clienteTempMat) {
                    $isMessageStart = true;
                    $this->conversationIntent($isMessageStart);

                    $this->logInteraction('document_number-client_identified', null, $documentNumber);
                }else {
                    $this->logInteraction('document_number-no_client_identified', null, $documentNumber);
                    $this->askIfNewStudent();
                }

            } else {
                $this->logInteraction('document_number-invalid', null, $documentNumber);
                $this->repeat('Número de documento inválido. Por favor intenta de nuevo.');
            }
        });
    }

    public function conversationIntent($isMessageStart=false, $newMessage=null)
    {
        //$msge = $this->botman->getMessage()->getText();
        //$this->logInteraction('initial_message', null, $msge);

        $documentNumber = $this->botman->userStorage()->get('documentNumber');
        $clienteTempMat = $this->conditionEvaluator->getClienteTempMatricula($documentNumber);

        $startMessage = $this->botman->userStorage()->get('startMessage');

        $message = $newMessage ? $newMessage : $startMessage;
        $interactionType = $newMessage ? 'new_message' : 'initial_message';

        $this->logInteraction($interactionType, null, $message);
        $intentName = $this->dialogflow->gettingIntent($message);

        Log::info('Dialogflow IntentName for DB Consulting: ' , ['intentName' => $intentName, 'Message' => $message]);

        $hola = $isMessageStart ? "Hola {$clienteTempMat->alumno}!" : "";

        // Buscar la opción del menú asociada al intent
        $selectedNextSubOption = MenuOption::where('intent', $intentName)->first();

        if ($selectedNextSubOption) {
            // Guardar el ID de la opción seleccionada en el almacenamiento del usuario
            $this->botman->userStorage()->save([
                'intentOptionParenId' => $selectedNextSubOption->id
            ]);

            //TODO: Revisar cuando la rpta esté vacío, ya que no devolverá las subopciones
            // Responder al usuario si hay una respuesta definida
            if (!empty(trim($selectedNextSubOption->respuesta))) {
                $this->bot->typesAndWaits(1);
                $this->say("{$hola}<p>Tu consulta es sobre <strong>{$selectedNextSubOption->desc_opcion}</strong></p>");
                $this->say($selectedNextSubOption->respuesta);

                $moreSubOptions = $this->getMoreSubOptions($selectedNextSubOption);

                if ($moreSubOptions->isEmpty() && !$selectedNextSubOption->executes_system_process) {
                    $this->askSatisfaction($moreSubOptions, $clienteTempMat);
                }

                if(!$selectedNextSubOption->executes_system_process) {
                    // Manejar la selección de la opción
                    $this->handleSelectedOption($selectedNextSubOption->id, $clienteTempMat);
                }else{
                    $this->handleOptionRoute($selectedNextSubOption, $clienteTempMat);

                    if ($moreSubOptions->isEmpty() && !$selectedNextSubOption->executes_system_process) {
                        $subOpciones = MenuOption::where('parent_id', $selectedNextSubOption->id)->get(['id', 'parent_id', 'desc_opcion', 'respuesta','executes_system_process']);
                        $this->askSatisfaction($subOpciones, $clienteTempMat);
                    } else {
                        $this->showSubOptions($moreSubOptions, $clienteTempMat);
                    }
                }
            }
        } else {
            // Mostrar opciones generales si no hay intent asociado
            $this->showOptions($clienteTempMat);
        }



        // if ($intentName === 'reactualizacion-matricula-calendario' || $intentName === 'reactualizacion-matricula') {
        //     $referIntentNextOptionId = $intentName === 'reactualizacion-matricula' ? 3 : 39;
        //     $selectedNextSubOption = MenuOption::find($referIntentNextOptionId);

        //     $this->botman->userStorage()->save([
        //         'intentOptionParenId' => $referIntentNextOptionId
        //     ]);


        //     if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
        //         $this->bot->typesAndWaits(1);
        //         $this->say("{$hola}<p>Tu consulta es sobre <strong>{$selectedNextSubOption->desc_opcion}</strong></p>");

        //         $this->say($selectedNextSubOption->respuesta);


        //         $this->handleSelectedOption($referIntentNextOptionId, $clienteTempMat);

        //     }
        // } elseif ($intentName === 'calendario_matricula') {
        //     $referIntentNextOptionId = 8;
        //     $selectedNextSubOption = MenuOption::find($referIntentNextOptionId);

        //     $this->botman->userStorage()->save([
        //         'intentOptionParenId' => $referIntentNextOptionId
        //     ]);

        //     if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
        //         $this->bot->typesAndWaits(1);
        //         $this->say("{$hola}<p>Tu consulta es sobre <strong>{$selectedNextSubOption->desc_opcion}</strong></p>");
        //         $this->say($selectedNextSubOption->respuesta);

        //         $this->handleSelectedOption($referIntentNextOptionId, $clienteTempMat);
        //     }

        // } else {
        //     $this->showOptions($clienteTempMat);
        // }
    }



    public function showOptions($clienteTempMat)
    {
        $msgeIni = "- Nuestro horario de atención para realizar tu matrícula es de 10 am a 6pm.<br>
                    - Para realizar tu matrícula no debes contar con deudas pendientes.<br>
                    - Si no estudiaste el ciclo anterior y no cuentas con reserva de matrícula, debes realizar la reactualización de tu matrícula.<br>
                    - Si no cuenta con tu correo institucional u olvidaste tu contraseña, deberás seleccionar la opción 6 de soporte informático.";

        $msgeIni .= "- <br>También puedes consultar en nuestro landing informativo: <a href='https://matricula.fcctp.edu.pe'><strong>Clic aquí</strong></a>";

        $startMessage = $this->botman->userStorage()->get('startMessage');

        $this->bot->typesAndWaits(2);
        if(!$startMessage) {
            $this->say("<strong>Hola {$clienteTempMat?->alumno}!</strong> <p>{$msgeIni}</p>");
        }else{
            $this->say("<p><strong>Lo siento, no entendí tu solicitud, recuerda que estoy orientado a resolver consultas sobre el proceso de matrícula actual. Toma en cuenta lo siguiente:</strong></p><p>{$msgeIni}</p>");
        }

        $options = MenuOption::whereNull('parent_id')->where('active', 1)->get(['id', 'desc_opcion', 'respuesta']);
        $questionText = '<strong>Elige una opción (escribe el número):</strong><br><br>';
        foreach ($options as $key => $opcion) {
            $description = $this->formatOptionDescription($opcion->desc_opcion);
            $questionText .= ($key + 1) . ". " . $description . "<br>";
        }
        $questionText .= ($options->count() + 1) . ". Nueva consulta<br>";

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_option');

        $this->ask($question, function (Answer $answer) use ($options, $clienteTempMat) {
            $optionIndex = (int) $answer->getText() - 1;

            //Log::info('Selected option', [$optionIndex, $options->count()]);

            if ($optionIndex >= 0 && $optionIndex < $options->count()) {
                $selectedOption = $options[$optionIndex];


                $validOptions = ((int)$clienteTempMat->estado === 1) ? [1,2,3,4,5,6,7] : [5, 6];

                $this->logInteraction('principal_option_selected', $selectedOption->id, $answer->getText());
                $this->botman->userStorage()->save([
                    'parent_id' => $selectedOption->id
                ]);

                if (in_array($selectedOption->id, $validOptions)) {
                    $this->bot->typesAndWaits(1);
                    $this->say('Has seleccionado: ' . $selectedOption->desc_opcion);

                    if ($selectedOption->respuesta && trim($selectedOption->respuesta) !== '') {
                        $this->say($selectedOption->respuesta);
                    }

                    // Manejo de la opción seleccionada
                    $this->handleSelectedOption($selectedOption->id, $clienteTempMat);


                } else {
                    $this->bot->typesAndWaits(1);
                    $this->say('Opción no permitida. Solo puedes seleccionar las opciones 5 o 6. Por favor, intenta de nuevo.');
                    $this->repeat();
                }
            } elseif ($optionIndex == $options->count()) {
                $indexResponse = 9;
                $this->logInteraction('principal_option_selected', null, $indexResponse);

                $this->ask("Ingrese su consulta", function (Answer $answer) {
                    Log::info('newMessage', ['newMessage' => $answer->getText()]);
                    $this->conversationIntent(false, $answer->getText());
                });

            } else {
                $this->logInteraction('principal_option_selected', null, $answer->getText());

                $this->bot->typesAndWaits(1);
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    }

    protected function handleSelectedOption($optionId, $clienteTempMat)
    {
        $subOpciones = MenuOption::where('parent_id', $optionId)
                                    ->where('active', 1)
                                    ->get(['id', 'parent_id', 'desc_opcion', 'respuesta','executes_system_process']);

        if ($subOpciones->isEmpty()) {
            //$this->say('No hay sub-opciones disponibles.');
            Log::info('No hay sub-opciones disponibles', ['parent_id' => $optionId]);
            return;
        }

        $this->showSubOptions($subOpciones, $clienteTempMat);
    }

    protected function showSubOptions($subOpciones, $clienteTempMat)
    {
        // Generar el texto de las opciones
        $questionText = $this->generateQuestionText($subOpciones);

        // Crear la pregunta
        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_sub_option');

        // Manejar la respuesta del usuario
        $this->ask($question, function (Answer $answer) use ($subOpciones, $clienteTempMat) {

            $selectedIndex = (int) $answer->getText() - 1;
            $countOtherOptions = $this->botman->userStorage()->get('countOtherOptions');
            //Log::info('tx opción', ['answ' => $answer->getText()]);
            Log::info('in', context: ['countOtherOptions' => $countOtherOptions, 'selectedIndex' => $selectedIndex, 'subopccount' => $subOpciones->count()]);
            //Log::info('abc', context: ['c' => ($countOtherOptions == 2 && $selectedIndex == $subOpciones->count())]);

            switch (true) {
                case $countOtherOptions === 3 && $selectedIndex == $subOpciones->count():
                    $this->handleBackOption($answer, $clienteTempMat);
                    break;

                case ($countOtherOptions === 3 && $selectedIndex == $subOpciones->count() + 1) || ($countOtherOptions == 2 && $selectedIndex == $subOpciones->count()):

                    $this->ask("Ingrese su consulta", function (Answer $answer) {
                       $newMessage = $answer->getText();
                        $this->botman->userStorage()->save([
                            'startMessage' => $newMessage
                        ]);

                        $this->conversationIntent();
                    });
                    break;

                case ($countOtherOptions === 2 && $selectedIndex == $subOpciones->count() + 1) || ($countOtherOptions === 3 && $selectedIndex == $subOpciones->count() + 2):
                    $this->handleFinishOption($answer, $subOpciones, $clienteTempMat);
                    break;

                case $selectedIndex >= 0 && $selectedIndex < $subOpciones->count():
                    $this->handleSubOptionSelection($subOpciones[$selectedIndex], $subOpciones, $clienteTempMat, $answer);
                    break;

                default:
                    $this->bot->typesAndWaits(1);
                    $this->say('Selección inválida. Por favor, intenta de nuevo.');
                    $this->repeat();
            }
        });
    }


/*     protected function showSubOptions_($subOpciones, $clienteTempMat)
    {
        $questionText = '<strong>Elige una opción escribiendo su número:</strong><br><br>';
        foreach ($subOpciones as $key => $subOpcion) {
            $description = $this->formatOptionDescription($subOpcion->desc_opcion);
            $questionText .= ($key + 1) . ". " . $description . "<br>";
        }
        $questionText .= ($subOpciones->count() + 1) . ". Regresar al menú anterior<br>";
        $questionText .= ($subOpciones->count() + 2) . ". Finalizar atención<br>";

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_sub_option');


        $this->ask($question, function (Answer $answer) use ($subOpciones, $clienteTempMat) {
            $subOptionIndex = (int) $answer->getText() - 1;

            if ($subOptionIndex == $subOpciones->count()) {
                $lastOoptionParenId = $this->botman->userStorage()->get('parent_id');

                Log::info('BackSubOptions getting parent_id', ['back_parent_id' => $lastOoptionParenId]);

                $lastSavedOption = MenuOption::find($lastOoptionParenId);

                $this->logInteraction('backreturn_option_selected', null, $answer->getText(), $lastOoptionParenId);

                if($lastSavedOption && $lastSavedOption->parent_id) {

                    $this->botman->userStorage()->save([
                        'parent_id' => $lastSavedOption->parent_id
                    ]);

                    Log::info('BackSubOptions for parent_id', ['back_parent_id' => $lastSavedOption->parent_id]);

                    $backSubOptions = MenuOption::where([
                        'parent_id' => $lastSavedOption->parent_id,
                        'is_system_option' => 0,
                        'active' => 1,
                    ])->get(['id', 'parent_id', 'desc_opcion', 'respuesta']);

                    $this->showSubOptions($backSubOptions, $clienteTempMat);

                }else{
                    $this->showOptions($clienteTempMat);
                }

            } elseif ($subOptionIndex == $subOpciones->count() + 1) {
                $this->bot->typesAndWaits(2);
                $this->say('Gracias por usar nuestro servicio. ¡Hasta luego!');
                $this->logInteraction('finish_option_selected', null, $answer->getText(), $this->botman->userStorage()->get('parent_id'));
                $this->askSatisfaction($subOpciones, $clienteTempMat);

            } elseif ( $subOptionIndex >= 0 && $subOptionIndex < $subOpciones->count() ) {
                $selectedSubOption = $subOpciones[$subOptionIndex];

                $description = $selectedSubOption->desc_opcion;

                $this->bot->typesAndWaits(1);
                $this->say('Has seleccionado: ' . $description);

                $this->logInteraction('child_option_selected', $selectedSubOption->id, $answer->getText(), $this->botman->userStorage()->get('parent_id'));


                $this->botman->userStorage()->save([
                    'parent_id' => $selectedSubOption->id
                ]);

                Log::info('SelectedSubOption for parent_id', ['id' => $selectedSubOption->id]);


                $moreSubOptions = MenuOption::where([
                                                'parent_id' => $selectedSubOption->id,
                                                'is_system_option' => 0,
                                                'active' => 1,
                                            ])->get(['id', 'parent_id', 'desc_opcion', 'respuesta', 'active']);

                if ($selectedSubOption->respuesta && trim($selectedSubOption->respuesta) !== '') {
                    $this->bot->typesAndWaits(1);
                    $this->say($selectedSubOption->respuesta);
                }

                if ( $selectedSubOption->optionRoute ) {
                    $nextOption = $this->conditionEvaluator->execInternalProcess($selectedSubOption->optionRoute, $clienteTempMat);
                    $nextOptionId = $nextOption[1];
                    $action = $nextOption[0];

                    $selectedNextSubOption = MenuOption::find($nextOptionId);

                    if( $action === 'FORNEXTOPTIONID' || $action === 'FORAMPLMATRICULA' ) {
                        $moreSubOptions = MenuOption::where([
                            'parent_id' => $nextOptionId,
                            'is_system_option' => 0,
                            'active' => 1,
                        ])->get(['id', 'parent_id', 'desc_opcion', 'respuesta', 'active']);


                        if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
                            $this->bot->typesAndWaits(1);
                            $this->say($selectedNextSubOption->respuesta);
                        }
                    }

                    if ($action === 'FORREPLYEXTEMP' || $action === 'FORREPLYLINKZOOM') {
                        if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
                            $this->bot->typesAndWaits(1);
                            $this->say($selectedNextSubOption->respuesta);
                        }
                    }
                }

                if ($moreSubOptions->isEmpty()) {
                    // Preguntar si está satisfecho
                    $this->askSatisfaction($subOpciones, $clienteTempMat);
                } else {
                    // Hay más sub-opciones, mostrar el siguiente nivel de sub-opciones
                    $this->showSubOptions($moreSubOptions, $clienteTempMat);
                }
            } else {
                $this->bot->typesAndWaits(1);
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    } */

    protected function askSatisfaction($subOpciones = null, $clienteTempMat = null)
    {
        $question = Question::create('¿Estás satisfecho(a) con mi respuesta?')
            ->addButtons([
                Button::create('Sí')->value('yes'),
                Button::create('No')->value('no'),
               # Button::create('Regresar al menú anterior')->value('menu'),
            ]);

        $this->ask($question, function (Answer $answer) use ($subOpciones, $clienteTempMat) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'yes') {
                    $this->bot->typesAndWaits(1);
                    $this->say('¡Gracias! Me alegra saber que estás satisfecho(a).');

                    $this->logInteraction('satisfaction_selected', null, $answer->getText(), $this->botman->userStorage()->get('parent_id'));

                    //$this->botman->userStorage()->delete();
                    /*
                    Log::info('sessions after delete()', [
                        'sessionId' => $this->sessionId,
                        'session_uuid' => $this->uuid,
                        'uuid' => $this->botman->userStorage()->get('session_uuid')
                    ]);
                    */

                    //$this->endSession();

                } elseif ($answer->getValue() === 'no') {
                    $this->bot->typesAndWaits(1);

                    $this->logInteraction('satisfaction_selected', null, $answer->getText(), $this->botman->userStorage()->get('parent_id'));

                    //$this->say('Lamento escuchar eso. Por favor, dime cómo puedo mejorar.');
                    $lastOoptionParenId = $this->botman->userStorage()->get('parent_id');

                    //Log::info('Destroying parent_id', ['id' => $lastOoptionParenId]);
                    //$this->botman->userStorage()->delete();


                    $this->ask('Lamento escuchar eso. Por favor, dime cómo puedo mejorar.', function (Answer $improvementAnswer) {
                        $userFeedback = $improvementAnswer->getText();
                        // Aquí puedes guardar el feedback del usuario en la base de datos o procesarlo de alguna forma
                        $this->bot->typesAndWaits(1);
                        $this->say('¡Gracias por tu comentario! Lo tendremos en cuenta para mejorar.');

                        $this->logInteraction('userFeedback_nosatisfaction', null, $userFeedback, $this->botman->userStorage()->get('parent_id'));

                        //$this->endSession();
                    });

                } elseif ($answer->getValue() === 'menu') {
                    $this->showSubOptions($subOpciones, $clienteTempMat);
                }
            } else {
                $this->bot->typesAndWaits(1);
                $this->logInteraction('satisfaction_typed', null, $answer->getText(), $this->botman->userStorage()->get('parent_id'));
                $this->say('Por favor, selecciona una opción.');
                $this->repeat();
            }
        });
    }

    protected function validateDocumentNumber($documentNumber)
    {
        // if ($this->documentType === 'dni') {
        //     return preg_match('/^\d{8}$/', $documentNumber);
        // } elseif ($this->documentType === 'ce') {
        //     return preg_match('/^[a-zA-Z0-9]{9,12}$/', $documentNumber);
        // }

        return preg_match('/^\d{8}$/', $documentNumber) || preg_match('/^[a-zA-Z0-9]{9,12}$/', $documentNumber);
    }


    public function askForStudentType()
    {
        $question = Question::create('Antes de ayudarte, señala tu tipo de documento por favor')
            ->fallback('No puedo ayudarte con eso')
            ->callbackId('ask_document_type')
            ->addButtons([
                Button::create('DNI')->value('dni'),
                Button::create('CE')->value('ce'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->documentType = $answer->getValue();
                $this->askForDocumentNumber();
            } else {
                $this->repeat('Por favor selecciona una opción válida.');
            }
        });
    }

    public function askIfNewStudent()
    {
        $question = Question::create('¿Eres un alumno ingresante?')
            ->fallback('Unable to ask if new student')
            ->callbackId('ask_if_new_student')
            ->addButtons([
                Button::create('Sí')->value('yes'),
                Button::create('No')->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'yes') {
                    $this->bot->typesAndWaits(1);

/*                     $msgeWelcome = "<strong>Bienvenido a tu primera matrícula!!!</strong>";
                    $msgeWelcome .= "<p>A partir del 23 de julio podrás realizar tu primera matrícula en la FCCTP de la USMP ingresando al siguiente enlace para contactarte con la Oficina de Registros Académicos quien, de ser necesario, te asistirá.</p>";
                    $msgeWelcome .= '<p><a href="https://usmp-edu-pe.zoom.us/j/83990742629" target="_blank"><strong>ACCESO A SALA ZOOM DE REGISTROS ACADÉMICOS</strong></a></p>';
                    $msgeWelcome .= "<p><br>Recuerda que también podrás realizar tu matrícula de manera autónoma ingresando al siguiente enlace:</p>";
                    $msgeWelcome .= '- <a href="https://fioriprd.udm.hec.ondemand.com/sap/bc/ui2/flp?sap-client=400" target="_blank"><strong>ACCESO A SAP</strong></a><br>';
                    $msgeWelcome .= '- <a href="https://www.youtube.com/watch?v=A7n1_akA_Y0"><strong>VIDEO TUTORIAL DE MATRÍCULA SAP</strong></a>';

                    $this->say($msgeWelcome); */

                    $this->logInteraction('newstudent-yes_selected', null, $answer->getText());


                    $intentName = '8_matricula-ingresantes';
                    $selectedNextSubOption = MenuOption::where('intent', $intentName)->first();

                    if ($selectedNextSubOption) {
                        if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
                            $this->bot->typesAndWaits(1);
                            $this->bot->userStorage()->save([
                                'parent_id' => $selectedNextSubOption->id
                            ]);
                            $this->say($selectedNextSubOption->respuesta);

                            $this->askSatisfaction();
                            $this->botman->userStorage()->delete();
                        }
                    }


                } elseif ($answer->getValue() === 'no') {
                    $this->bot->typesAndWaits(1);
                    $this->logInteraction('newstudent-no_selected', null, $answer->getText());
                    $this->say('Puedes escribirnos a soporte_fcctp@usmp.pe y escribe tu caso.');
                }

            }
        });
    }

    public function formatOptionDescription($description)
    {
        return preg_replace('/^\d+(\.\d+)*\.\s*/', '', $description);
    }

    public function initializeSessionId()
    {
        if ($this->sessionId === null) {
            $this->sessionId = $this->botman->getUser()->getId();
        }

        $this->uuid = $this->botman->userStorage()->get('session_uuid');

        if (!$this->uuid) {
            $this->uuid = (string) Str::uuid();
            $this->botman->userStorage()->save([
                'session_uuid' => $this->uuid
            ]);
        }

        Log::info(
            'sessions Initialized',
            [
                'sessionId' => $this->sessionId,
                'session_uuid' => $this->uuid,
                'uuid' => $this->botman->userStorage()->get('session_uuid')
            ]
        );
    }

    public function startSession()
    {
        $agent = new Agent();
        $browser = $agent->browser();

        $platform = $agent->platform();
        $version = $agent->version($platform);
        $botSession = BotSession::updateOrCreate(
            [
                'session_id' => $this->sessionId,
                'uuid' => $this->uuid
            ],
            [
                'doc_number' => null,
                'started_at' => Carbon::now(),
                'ended_at' => null,
                'device' => $agent->device(),
                'browser' => $browser,
                'browser_version' => $agent->version($browser),
                'platform' => $platform,
                'platform_version' => $version,
                'ip' => request()->ip()
            ]
        );

        $this->botSessionId = $botSession->id;


    }

    protected function endSession()
    {
        BotSession::where([
            'session_id' => $this->sessionId,
            'uuid' => $this->uuid
        ])
            ->update(['ended_at' => Carbon::now()]);
    }

    protected function sessionWithDocNumber($docNumber)
    {
        BotSession::where([
            'session_id' => $this->sessionId,
            'uuid' => $this->uuid
        ])
            ->update(['doc_number' => $docNumber]);
    }

    public function logInteraction($action, $optionSelected = null, $message = null, $parent_id = null)
    {
        BotInteraction::create([
            'bot_session_id' => $this->botSessionId,
            'session_id' => $this->sessionId,
            'uuid' => $this->uuid,
            'interaction_type' => $action,
            'option_selected' => $optionSelected,
            'response' => $message,
            'option_parent' => $parent_id
        ]);
    }

    // Generar texto de la pregunta
    protected function generateQuestionText($subOpciones)
    {
        $questionText = '<strong>Para continuar, elige una opción escribiendo su número:</strong><br><br>';
        foreach ($subOpciones as $key => $subOpcion) {
            $description = $this->formatOptionDescription($subOpcion->desc_opcion);
            $questionText .= ($key + 1) . ". " . $description . "<br>";
        }
        $lastOptionParentId = $this->botman->userStorage()->get('parent_id');
        $intentOptionParenId = $this->botman->userStorage()->get('intentOptionParenId');

        $countOtherOption = 0;
        if( $lastOptionParentId > 0 && $lastOptionParentId !== $intentOptionParenId ) {
            ++$countOtherOption;
            $questionText .= ($subOpciones->count() + $countOtherOption) . ". Regresar al menú anterior<br>";
        }
        $questionText .= ($subOpciones->count() + ++$countOtherOption) . ". Nueva consulta<br>";
        $questionText .= ($subOpciones->count() + ++$countOtherOption) . ". Finalizar atención<br>";

        $this->botman->userStorage()->save(['countOtherOptions' => $countOtherOption]);
        Log::info('lastOptionParentId, intentOptionParenId, countOtherOption', ['lastOptionParentId' => $lastOptionParentId, 'intentOptionParenId'=>$intentOptionParenId, 'countOtherOption' => $countOtherOption]);

        return $questionText;
    }

    // Manejar la opción "Regresar al menú anterior"
    protected function handleBackOption(Answer $answer, $clienteTempMat)
    {
        $parentId = $this->botman->userStorage()->get('parent_id');
        Log::info('BackSubOptions getting parent_id', ['back_parent_id' => $parentId]);

        $lastOption = MenuOption::find($parentId);

        $this->logInteraction('backreturn_option_selected', null, $answer->getText(), $parentId);

        if ($lastOption && $lastOption->parent_id) {
            $this->botman->userStorage()->save(['parent_id' => $lastOption->parent_id]);
            Log::info('BackSubOptions for parent_id', ['back_parent_id' => $lastOption->parent_id]);

            $backSubOptions = MenuOption::where([
                'parent_id' => $lastOption->parent_id,
                'is_system_option' => 0,
                'active' => 1,
            ])->get(['id', 'parent_id', 'desc_opcion', 'respuesta']);

            $this->showSubOptions($backSubOptions, $clienteTempMat);
        } else {
            $this->showOptions($clienteTempMat);
        }
    }

    // Manejar la opción "Finalizar atención"
    protected function handleFinishOption(Answer $answer, $subOpciones, $clienteTempMat)
    {
        $this->bot->typesAndWaits(2);
        $this->say('Gracias por usar nuestro servicio. ¡Hasta luego!');
        $this->logInteraction('finish_option_selected', null, $answer->getText(), $this->botman->userStorage()->get('parent_id'));
        $this->askSatisfaction($subOpciones, $clienteTempMat);
    }

    // Manejar la selección de una sub-opción
    protected function handleSubOptionSelection($selectedSubOption, $subOpciones, $clienteTempMat, Answer $answer)
    {
        $this->bot->typesAndWaits(1);
        $this->say('Has seleccionado: ' . $selectedSubOption->desc_opcion);

        $this->logInteraction('child_option_selected', $selectedSubOption->id, $answer->getText(), $this->botman->userStorage()->get('parent_id'));
        $this->botman->userStorage()->save(['parent_id' => $selectedSubOption->id]);

        Log::info('SelectedSubOption for parent_id', ['id' => $selectedSubOption->id]);

        $moreSubOptions = $this->getMoreSubOptions($selectedSubOption);

        Log::info('Selected moreSubOptions', ['selectedSubOption' => $selectedSubOption, 'moreSubOptions' => $moreSubOptions]);

        if ($selectedSubOption->respuesta && trim($selectedSubOption->respuesta) !== '') {
            $this->bot->typesAndWaits(1);
            $this->say($selectedSubOption->respuesta);
        }

        if (!empty($selectedSubOption->optionRoute)) {
            $this->handleOptionRoute($selectedSubOption, $clienteTempMat);
        }

        Log::info('selectedSubOption exec executes_system_process', ['executes_system_process ' => $selectedSubOption->executes_system_process]);

        if (!$selectedSubOption->executes_system_process) {
            if ($moreSubOptions->isEmpty()) {
                $this->askSatisfaction($subOpciones, $clienteTempMat);
            } else {
                $this->showSubOptions($moreSubOptions, $clienteTempMat);
            }
        }

    }

    // Obtener más sub-opciones
    protected function getMoreSubOptions($selectedSubOption)
    {
        return MenuOption::where([
            'parent_id' => $selectedSubOption->id,
            'is_system_option' => 0,
            'active' => 1,
        ])->get(['id', 'parent_id', 'desc_opcion', 'respuesta', 'active','executes_system_process']);
    }

    // Manejar rutas de opciones
    protected function handleOptionRoute($selectedSubOption, $clienteTempMat)
    {
        $nextOption = $this->conditionEvaluator->execInternalProcess($selectedSubOption->optionRoute, $clienteTempMat);
        $nextOptionId = $nextOption[1];
        $action = $nextOption[0];

        $nextSubOption = MenuOption::find($nextOptionId);
        Log::info("handleOptionRoute", ["nextOption" => $nextOption, "nextSubOption" => $nextSubOption]);
        $moreSubOptions = $this->getMoreSubOptions($nextSubOption);

        if (in_array($action, ['FORNEXTOPTIONID', 'FORAMPLMATRICULA'])) {
            if ($nextSubOption->respuesta && trim($nextSubOption->respuesta) !== '') {
                $this->bot->typesAndWaits(1);
                $this->say($nextSubOption->respuesta);
            }
        } elseif (in_array($action, ['FORREPLYEXTEMP', 'FORREPLYLINKZOOM'])) {
            if ($nextSubOption->respuesta && trim($nextSubOption->respuesta) !== '') {
                $this->bot->typesAndWaits(1);
                $this->say($nextSubOption->respuesta);
            }
        }


        if ($moreSubOptions->isEmpty()) {
            $subOpciones = MenuOption::where('parent_id', $nextSubOption->id)->get(['id', 'parent_id', 'desc_opcion', 'respuesta', 'executes_system_process']);
            $this->askSatisfaction($subOpciones, $clienteTempMat);
        } else {
            $this->showSubOptions($moreSubOptions, $clienteTempMat);
        }

    }
}

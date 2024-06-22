<?php

namespace App\Http\Conversations;

use App\Models\MenuOption;
use App\Models\SapM\Cliente;
use App\Services\ConditionEvaluatorService;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;


class SelectingDocTypeConversation extends Conversation
{

    protected $documentType;
    protected $conditionEvaluator;

    public function __construct(ConditionEvaluatorService $conditionEvaluator)
    {
        $this->conditionEvaluator = $conditionEvaluator;
    }

    /**
     */
    public function run() : void
    {
        $this->askForDocumentType();
    }



    /*public function askForDocumentNumber0()
    {
        $documentTypeName = $this->documentType == 'dni' ? 'DNI' : 'CE';
        $question = Question::create("Ingresa tu $documentTypeName:")
            ->fallback('No puedo ayudarte con eso');

        $this->ask($question, function (Answer $answer) {
            if ($answer->getText() !== null) {
                $documentNumber = $answer->getText();
                // Aquí puedes procesar el número de documento según el tipo seleccionado
                $this->say('Gracias por proporcionar tu número de documento.');
            } else {
                $this->say('Por favor, ingresa un número de documento válido.');
                $this->repeat();
            }
        });
    }*/

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
        $documentText = $this->documentType === 'dni' ? 'Ingresa tu DNI' : 'Ingresa tu CE';

        $this->ask($documentText, function (Answer $answer) {

            $documentNumber = $answer->getText();

            if ($this->validateDocumentNumber($documentNumber)) {

                $clienteTempMat = $this->conditionEvaluator->getClienteTempMatricula($documentNumber);


                if($clienteTempMat) {
                    $this->showOptions($clienteTempMat);
                }else {
                    $this->askIfNewStudent();
                    //$this->repeat('No encontramos. Por favor intenta de nuevo o escribenos a sap_fcctp@usmp.pe reportando el problema.');
                }

            } else {
                $this->repeat('Número de documento inválido. Por favor intenta de nuevo.');
            }
        });
    }

    public function showOptions($clienteTempMat)
    {
        $this->say("Hola {$clienteTempMat->alumno}!");
        $options = MenuOption::whereNull('menu_option_id')->get(['id', 'desc_opcion']);
        $questionText = '<strong>Elige una opción (escribe el número):</strong><br><br>';
        foreach ($options as $key => $opcion) {
            $description = $this->formatOptionDescription($opcion->desc_opcion);
            $questionText .= ($key + 1) . ". " . $description . "<br>";
        }

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_option');

        $this->ask($question, function (Answer $answer) use ($options, $clienteTempMat) {
            $optionIndex = (int) $answer->getText() - 1;

            if ($optionIndex >= 0 && $optionIndex < $options->count()) {
                $selectedOption = $options[$optionIndex];
                $this->say('Has seleccionado: ' . $selectedOption->desc_opcion);

                // Manejo de la opción seleccionada
                $this->handleSelectedOption($selectedOption->id, $clienteTempMat);
            } else {
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    }

    protected function handleSelectedOption($optionId, $clienteTempMat)
    {
        $subOpciones = MenuOption::where('menu_option_id', $optionId)->where('muestra_pantalla', 1)->get(['id', 'desc_opcion', 'respuesta', 'condiciones_proceso']);

        if ($subOpciones->isEmpty()) {
            $this->say('No hay sub-opciones disponibles.');
            return;
        }

        $this->showSubOptions($subOpciones, $clienteTempMat);
    }


    protected function showSubOptions($subOpciones, $clienteTempMat)
    {
        $questionText = '<strong>Elige una opción escribiendo su número:</strong><br><br>';
        foreach ($subOpciones as $key => $subOpcion) {
            $description = $this->formatOptionDescription($subOpcion->desc_opcion);
            $questionText .= ($key + 1) . ". " . $description . "<br>";
        }
        $questionText .= ($subOpciones->count() + 1) . ". Regresar al menú anterior<br>";

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_sub_option');

        $this->ask($question, function (Answer $answer) use ($subOpciones, $clienteTempMat) {
            $subOptionIndex = (int) $answer->getText() - 1;

            if ($subOptionIndex == $subOpciones->count()) {
                $this->showOptions($clienteTempMat);
            } elseif ($subOptionIndex >= 0 && $subOptionIndex < $subOpciones->count()) {
                $selectedSubOption = $subOpciones[$subOptionIndex];

                $description = $selectedSubOption->desc_opcion;
                $this->say('Has seleccionado: ' . $description);

                // Continuar el flujo de la conversación aquí
                //$this->say($selectedSubOption->respuesta);
                // Preguntar si está satisfecho
                //$this->askSatisfaction($subOpciones, $studentName);
                // Verificar si hay más sub-opciones
                $moreSubOptions = MenuOption::where('menu_option_id', $selectedSubOption->id)->where('muestra_pantalla', 1)->get(['id', 'desc_opcion', 'respuesta', 'condiciones_proceso']);


                if ($selectedSubOption->respuesta && trim($selectedSubOption->respuesta) !== '') {
                    // No hay más sub-opciones, mostrar la respuesta final
                    $this->say($selectedSubOption->respuesta);
                }


                if ($selectedSubOption->condiciones_proceso && trim($selectedSubOption->condiciones_proceso) !== '') {
                    $codEsc = $clienteTempMat->cod_esc;
                    $ciclo = (int)$clienteTempMat->ciclo;


                    $nextOptionId = $this->conditionEvaluator->evaluateConditions($selectedSubOption->condiciones_proceso, $codEsc, $ciclo);
                    //dd($nextOptionId);
                    $moreSubOptions = MenuOption::where('menu_option_id', $nextOptionId)->where('muestra_pantalla', 1)->get(['id', 'desc_opcion', 'respuesta', 'condiciones_proceso']);

                    //$nextOptionId = 'aa';
                    //$this->say('nextopt-' .$nextOptionId);

                    $selectedNextSubOption = MenuOption::find($nextOptionId);
                    if ($selectedNextSubOption->respuesta && trim($selectedNextSubOption->respuesta) !== '') {
                        $this->say($selectedNextSubOption->respuesta);
                    }
                    //$this->showSubOptions($moreSubOptions, $studentName);

                }


                if ($moreSubOptions->isEmpty()) {
                    // Preguntar si está satisfecho
                    $this->askSatisfaction($subOpciones, $clienteTempMat);
                } else {
                    // Hay más sub-opciones, mostrar el siguiente nivel de sub-opciones
                    $this->showSubOptions($moreSubOptions, $clienteTempMat);
                }
            } else {
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    }

    protected function askSatisfaction($subOpciones, $clienteTempMat)
    {
        $question = Question::create('¿Estás satisfecho(a) con mi respuesta?')
            ->addButtons([
                Button::create('Sí')->value('yes'),
                Button::create('No')->value('no'),
                Button::create('Regresar al menú anterior')->value('menu'),
            ]);

        $this->ask($question, function (Answer $answer) use ($subOpciones, $clienteTempMat) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'yes') {
                    $this->say('¡Gracias! Me alegra saber que estás satisfecho(a).');
                } elseif ($answer->getValue() === 'no') {
                    $this->say('Lamento escuchar eso. Por favor, dime cómo puedo mejorar.');
                } elseif ($answer->getValue() === 'menu') {
                    $this->showSubOptions($subOpciones, $clienteTempMat);
                }
            } else {
                $this->say('Por favor, selecciona una opción.');
                $this->repeat();
            }
        });
    }

    protected function validateDocumentNumber($documentNumber)
    {
        if ($this->documentType === 'dni') {
            return preg_match('/^\d{8}$/', $documentNumber);
        } elseif ($this->documentType === 'ce') {
            return preg_match('/^[a-zA-Z0-9]{9,12}$/', $documentNumber);
        }

        return false;
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
                    $this->say('Información importante que debes de saber previo al día de tu matrícula..');
                } elseif ($answer->getValue() === 'no') {
                    $this->say('Más info.. posible traslado interno.. no pertenece a fcctp..');
                }

            }
        });
    }

    public function formatOptionDescription($description)
    {
        return preg_replace('/^\d+(\.\d+)*\.\s*/', '', $description);
    }
}

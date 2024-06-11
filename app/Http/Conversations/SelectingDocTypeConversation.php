<?php

namespace App\Http\Conversations;

use App\Models\MenuOption;
use App\Models\SapM\Cliente;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;


class SelectingDocTypeConversation extends Conversation
{

    protected $documentType;

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
                $cliente = Cliente::where('dni', $documentNumber)->first();
                if($cliente) {
                    $nom = $cliente->nom1;
                    $this->showOptions($nom);
                }else {
                    $this->repeat('No encontramos. Por favor intenta de nuevo o escribenos a sap_fcctp@usmp.pe reportando el problema.');
                }

            } else {
                $this->repeat('Número de documento inválido. Por favor intenta de nuevo.');
            }


        });
    }

    public function showOptions($studentName)
    {
        $this->say("Hola {$studentName}!");

        /*$options = [
            'Matrícula de cursos',
            'Reserva de matrícula',
            'Reactualización de matrícula (SI DEJASTE DE ESTUDIAR UNO O MÁS CICLOS)',
            'Convalidación de asignaturas',
            'Deficiencia Académica',
            'Soporte informático',
            'Consulta Académica',
        ];*/

        $options = MenuOption::whereNull('menu_option_id')->get(['id', 'descripcion']);
        $questionText = '<strong>Elige una opción (escribe el número):</strong><br><br>';
        foreach ($options as $key => $opcion) {
            $questionText .= ($key + 1) . ". " . $opcion->descripcion . "<br>";
        }

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_option');

        $this->ask($question, function (Answer $answer) use ($options, $studentName) {
            $optionIndex = (int) $answer->getText() - 1;

            if ($optionIndex >= 0 && $optionIndex < $options->count()) {
                $selectedOption = $options[$optionIndex];
                $this->say('Has seleccionado: ' . $selectedOption->descripcion);

                // Manejo de la opción seleccionada
                $this->handleSelectedOption($selectedOption->id, $studentName);
            } else {
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    }

    protected function handleSelectedOption($optionId, $studentName)
    {
        $subOpciones = MenuOption::where('menu_option_id', $optionId)->get(['id', 'descripcion', 'contenido']);

        if ($subOpciones->isEmpty()) {
            $this->say('No hay sub-opciones disponibles.');
            return;
        }

        $this->showSubOptions($subOpciones, $studentName);
    }


    protected function showSubOptions($subOpciones, $studentName)
    {
        $questionText = '<strong>Elige una opción escribiendo su número:</strong><br><br>';
        foreach ($subOpciones as $key => $subOpcion) {
            $questionText .= ($key + 1) . ". " . $subOpcion->descripcion . "<br>";
        }
        $questionText .= ($subOpciones->count() + 1) . ". Regresar al menú anterior<br>";

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_sub_option');

        $this->ask($question, function (Answer $answer) use ($subOpciones, $studentName) {
            $subOptionIndex = (int) $answer->getText() - 1;

            if ($subOptionIndex == $subOpciones->count()) {
                $this->showOptions($studentName);
            } elseif ($subOptionIndex >= 0 && $subOptionIndex < $subOpciones->count()) {
                $selectedSubOption = $subOpciones[$subOptionIndex];
                $this->say('Has seleccionado: ' . $selectedSubOption->descripcion);

                // Continuar el flujo de la conversación aquí
                $this->say($selectedSubOption->contenido);

                // Preguntar si está satisfecho
                $this->askSatisfaction($subOpciones, $studentName);
            } else {
                $this->say('Selección inválida. Por favor, intenta de nuevo.');
                $this->repeat();
            }
        });
    }

    protected function askSatisfaction($subOpciones, $studentName)
    {
        $question = Question::create('¿Estás satisfecho(a) con mi respuesta?')
            ->addButtons([
                Button::create('Sí')->value('yes'),
                Button::create('No')->value('no'),
                Button::create('Regresar al menú anterior')->value('menu'),
            ]);

        $this->ask($question, function (Answer $answer) use ($subOpciones, $studentName) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'yes') {
                    $this->say('¡Gracias! Me alegra saber que estás satisfecho(a).');
                } elseif ($answer->getValue() === 'no') {
                    $this->say('Lamento escuchar eso. Por favor, dime cómo puedo mejorar.');
                } elseif ($answer->getValue() === 'menu') {
                    $this->showSubOptions($subOpciones, $studentName);
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

}

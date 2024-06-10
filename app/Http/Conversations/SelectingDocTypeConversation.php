<?php

namespace App\Http\Conversations;

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

    public function askForDocumentNumber0()
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
    }

    public function askForDocumentType()
    {
        $question = Question::create('¿Qué tipo de documento tienes?')
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


            // Aquí procesa la respuesta del usuario (el número de documento)
            // Puedes utilizar $answer->getText() para obtener el texto ingresado
            // Luego, muestra las opciones correspondientes según el documento ingresado
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
        $this->say("Bienvenido alumno: $studentName");

        $options = [
            'Matrícula de cursos',
            'Reserva de matrícula',
            'Reactualización de matrícula (SI DEJASTE DE ESTUDIAR UNO O MÁS CICLOS)',
            'Convalidación de asignaturas',
            'Deficiencia Académica',
            'Soporte informático',
            'Consulta Académica',
        ];

        /*
        $message = "Selecciona una opción:<br>";
        foreach ($options as $key => $option) {
            $message .= ($key + 1) . ". " . $option . "<br>";
        }

        $this->say($message);*/

        $questionText = 'Selecciona una opción:<br>';
        foreach ($options as $key => $option) {
            $questionText .= ($key + 1) . ". " . $option . "<br>";
        }

        $question = Question::create($questionText)
            ->fallback('No puedo procesar tu solicitud')
            ->callbackId('select_option');

        $this->ask($question, function (Answer $answer) use ($options) {
            $optionIndex = (int) $answer->getText();
            $selectedOption = $options[$optionIndex - 1];
            $this->say('Has seleccionado: ' . $selectedOption);
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

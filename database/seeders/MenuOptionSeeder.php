<?php

namespace Database\Seeders;

use App\Models\MenuOption;
use Illuminate\Database\Seeder;

class MenuOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuOptions = [
            '1. Matrícula de cursos' => [
                '1.1. Matrícula' => [
                    '1.1.1. Matrícula regular' => [
                        '1.1.1.1. CC ∈ [9,10]' => [
                            '1.1.1.1.1. Matrícula asistida',
                            '1.1.1.1.2. Finalizar atención',
                            '1.1.1.1.3. Menú anterior'
                        ],
                        '1.1.1.2. CC ∈ [1,8]' => [
                            '1.1.1.2.1. Referencia de asignaturas',
                            '1.1.1.2.2. Promedio ponderado',
                            '1.1.1.2.3. Menú anterior'
                        ]
                    ],
                    '1.1.2. Matrícula Incoming',
                    '1.1.3. Matrícula extemporánea',
                    '1.1.4. Menú anterior'
                ],
                '1.2. Rectificación de Matrícula',
                '1.3. Ampliación de Matrícula',
                '1.4. Menú anterior'
            ],
            '2. Reserva de matrícula',
            '3. Reactualización de matrícula' => [
                '3.1. Fechas y plazos para reactualización de matrícula',
                '3.2. Procedimiento o guía para reactualización',
                '3.3. Realizar reactualización de matrícula'
            ],
            '4. Convalidación de asignaturas',
            '5. Deficiencia Académica',
            '6. Soporte informático',
            '7. Consulta Académica'
        ];

        $menuOptionRptas = [
            '1.1. Matrícula' => '[RESPUESTA]
                                [DISPLAY.ON.SCREEN]
                                Enviar información de cronograma y guía
                                de matrícula y link
                                de acceso a SAP',
            '1.1.1.1. CC ∈ [9,10]' =>'[RESPUESTA]
            [DISPLAY.ON.SCREEN]
            Enviar información de fórmula de matrícula según ciclo de referencia',
            '3.1. Fechas y plazos para reactualización de matrícula' => '<strong>Recepción de solicitudes extemporáneas a través de la plataforma:</strong><br>📅 Del miércoles 15 de mayo al viernes 28 de junio.  <br>
                👉 Obtén más información <a href="https://fcctp.usmp.edu.pe/site/alumnos/servicios-academicos/registros-academicos/alumnos-pregrado/procesos-academicos-pregrado/" target="_blank">aquí</a>.',
            '3.2. Procedimiento o guía para reactualización' => '<p>Tr&aacute;mite que solicita el alumno si deja de estudiar por uno o m&aacute;s semestres acad&eacute;micos y no tiene reserva de matr&iacute;cula vigente para el semestre 2024-II. En tal sentido, debe solicitar reactualizaci&oacute;n de matr&iacute;cula para el periodo 2024-II.</p>
                <p><strong>Recepci&oacute;n de solicitudes a trav&eacute;s de la plataforma:</strong><br /><a href="https://appfcctp.usmp.edu.pe/mi-tramite/reactualizacion-matricula" target="_blank">Has clic aqu&iacute;</a></p>
                <p><strong>Consulta del estado de la solicitud de reactualizaci&oacute;n de matr&iacute;cula 2024-II:</strong><br /><a href="https://appfcctp.usmp.edu.pe/mi-tramite/reactualizacion-matricula/estado" target="_blank">Has clic aqu&iacute;</a></p>',
            '3.3. Realizar reactualización de matrícula' => '<p>Si dejaste de estudiar por uno o m&aacute;s semestres acad&eacute;micos y no tienes reserva de matr&iacute;cula vigente, puedes solicitar tu <strong>REACTUALIZACI&Oacute;N DE MATR&Iacute;CULA</strong> para el semestre <strong>2024-2</strong> mediante el siguiente formulario.</p>
                <p>🚨 Recuerda de no tener deuda pendiente</p>
                <br>
                <p><a href="https://appfcctp.usmp.edu.pe/mi-tramite/reactualizacion-matricula" target="_blank">Has clic aqu&iacute; para iniciar solicitud</a></p>
                <p>&nbsp;</p>'
        ];


        foreach ($menuOptions as $key => $value) {
            if (is_array($value)) {
                $this->crearOpcionRecursiva($key, $value, null, $menuOptionRptas);
            } else {
                $this->crearOpcion($value);
            }
        }
    }

    /**
     * Crear una nueva opción.
     *
     * @param string $descripcion
     * @param int|null $parentId
     * @param string|null $respuesta
     * @return \App\Models\MenuOption
     */
    protected function crearOpcion($descripcion, $parentId = null, $respuesta = null)
    {
        return MenuOption::create([
            'desc_opcion' => $descripcion,
            'menu_option_id' => $parentId,
            'active' => true,
            'num_opcion' => MenuOption::where('menu_option_id', $parentId)->count() + 1,
            'respuesta' => $respuesta
        ]);
    }

    /**
     * Crear opciones de manera recursiva.
     *
     * @param string $descripcion
     * @param array $subopciones
     * @param int|null $parentId
     * @param array $menuOptionRptas
     * @return void
     */
    protected function crearOpcionRecursiva($descripcion, $subopciones, $parentId = null, $menuOptionRptas = [])
    {
        $respuesta = $menuOptionRptas[$descripcion] ?? null;
        $opcion = $this->crearOpcion($descripcion, $parentId, $respuesta);

        foreach ($subopciones as $key => $value) {
            if (is_array($value)) {
                $this->crearOpcionRecursiva($key, $value, $opcion->id, $menuOptionRptas);
            } else {
                $respuesta = $menuOptionRptas[$value] ?? null;
                $this->crearOpcion($value, $opcion->id, $respuesta);
            }
        }
    }
}

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
            'Matrícula de cursos' => [
                'Matrícula' => [
                    'Matrícula regular' => [
                        'CC ∈ [9,10]' => [
                            'Matrícula asistida',
                            'Finalizar atención',
                            'Menú anterior'
                        ],
                        'CC ∈ [1,8]' => [
                            'Referencia de asignaturas',
                            'Promedio ponderado',
                            'Menú anterior'
                        ]
                    ],
                    'Matrícula Incoming',
                    'Matrícula extemporánea',
                    'Menú anterior'
                ],
                'Rectificación de Matrícula',
                'Ampliación de Matrícula',
                'Menú anterior'
            ],
            'Reserva de matrícula',
            'Reactualización de matrícula' => [
                'Fechas y plazos para reactualización de matrícula',
                'Procedimiento o guía para reactualización',
                'Realizar reactualización de matrícula'
            ],
            'Convalidación de asignaturas',
            'Deficiencia Académica',
            'Soporte informático',
            'Consulta Académica'
        ];

        foreach ($menuOptions as $key => $value) {
            if (is_array($value)) {
                $this->crearOpcionRecursiva($key, $value);
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
     * @return \App\Models\MenuOption
     */
    protected function crearOpcion($descripcion, $parentId = null)
    {
        return MenuOption::create([
            'descripcion' => $descripcion,
            'menu_option_id' => $parentId,
            'active' => true,
            'orden' => MenuOption::where('menu_option_id', $parentId)->count() + 1
        ]);
    }

    /**
     * Crear opciones de manera recursiva.
     *
     * @param string $descripcion
     * @param array $subopciones
     * @param int|null $parentId
     * @return void
     */
    protected function crearOpcionRecursiva($descripcion, $subopciones, $parentId = null)
    {
        $opcion = $this->crearOpcion($descripcion, $parentId);

        foreach ($subopciones as $key => $value) {
            if (is_array($value)) {
                $this->crearOpcionRecursiva($key, $value, $opcion->id);
            } else {
                $this->crearOpcion($value, $opcion->id);
            }
        }
    }
}

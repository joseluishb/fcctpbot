<?php

namespace Database\Seeders;

use App\Models\MenuOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opcionesPrincipales = [
            'Matrícula de cursos',
            'Reserva de matrícula',
            'Reactualización de matrícula',
            'Convalidación de asignaturas',
            'Deficiencia Académica',
            'Soporte informático',
            'Consulta Académica',
        ];

        foreach ($opcionesPrincipales as $opcion) {
            $this->crearOpcion($opcion);
        }

        // Subopciones tramdocreact
        $subopciones = [
            'Reactualización de matrícula' => [
                'Fechas y plazos para reactualización de matrícula',
                'Procedimiento o guía para reactualización',
                'Realizar reactualización de matrícula'
            ],
        ];

        foreach ($subopciones as $opcionPadre => $subopcionesArray) {
            $padre = MenuOption::where('descripcion', $opcionPadre)->first();

            foreach ($subopcionesArray as $subopcion) {
                $this->crearOpcion($subopcion, $padre->id);
            }
        }
    }

    /**
     * Crear una nueva opción.
     *
     * @param string $descripcion
     * @param int|null $opcion_menu_id
     * @return void
     */
    protected function crearOpcion($descripcion, $opcion_menu_id = null)
    {
        $contenido = ($opcion_menu_id === 8) ? '<strong>Recepción de solicitudes extemporáneas a través de la plataforma:</strong><br>Del miércoles 15 de mayo al viernes 28 de junio' : '--';
        MenuOption::create([
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'menu_option_id' => $opcion_menu_id,
            'tipo_accion' => 'menu',
            'codper' => '2024-2',
            'active' => true
        ]);
    }

}

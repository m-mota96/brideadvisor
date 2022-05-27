<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
               'name'=>'Personaliza el estilo de tu boda',
            ],

            [
               'name'=>'Define tu presupuesto',
            ],

            [
                'name'=>'Completa la información de tu perfil',
             ],
             [
                'name'=>'Descarga la app Bride Advisor',
             ],
 
             [
                'name'=>'Establece fecha y horario de tu boda.',
             ],
 
             [
                 'name'=>'Elegir y reservar el lugar de la ceremonia religiosa.',
              ],
              [
                'name'=>'Acudir con un wedding planner.',
             ],
 
             [
                'name'=>'Organiza tus tareas.',
             ],
 
             [
                 'name'=>'Crea tu lista de invitados.',
              ],
              [
                'name'=>'Personaliza tu mesa de regalos.',
             ],
 
             [
                'name'=>'Buscar y elegir al menos 5 opciones para la recepción de tu boda. ',
             ],
 
             [
                 'name'=>'Comienza a personalizar tu sitio web. ',
              ],
              [
                'name'=>'Definir y reservar el lugar de recepción.',
             ],
 
             [
                'name'=>'Comenzar a buscar tu vestido ideal.',
             ],
 
             [
                 'name'=>'Reservar banquete y mobiliario.',
              ],
              [
                'name'=>'Agenda tu cita para maquillaje y peinado.',
             ],
 
             [
                'name'=>'Reserva tu noche de bodas en el hotel de tu preferencia.',
             ],
 
             [
                 'name'=>'Buscar y reservar servicio de fotografía y video.',
              ],
              [
                'name'=>'Comienza a enviar tu “Save the date” a tus invitados.',
             ],
 
             [
                'name'=>'Reservar servicio de catering',
             ],
 
             [
                 'name'=>'Comparte el enlace de tu sitio web con tus invitados. ',
              ],
              [
                'name'=>'Buscar proveedor de invitaciones.',
             ],
 
             [
                'name'=>'Define tus damas de honor. ',
             ],
 
             [
                 'name'=>'Define tus padrinos de velación.',
              ],
              [
                'name'=>'Buscar proveedor de decoración floral.',
             ],
 
             [
                'name'=>'Color de vestido de tus damas de honor.',
             ],
 
             [
                 'name'=>'Elegir el traje del novio.',
              ],
              [
                'name'=>'Definan juntos la decoración de a ceremonia.',
             ],
 
             [
                'name'=>'Elegir y comprar vestido de novia.',
             ],
 
             [
                 'name'=>'Definir accesorios de novia.',
              ],
              [
                'name'=>'Comiencen a buscar opciones para tu luna de miel.',
             ],
 
             [
                'name'=>'Buscar opciones de música en vivo.',
             ],
 
             [
                 'name'=>'Comienza a crear el itinerario del día de tu boda.',
              ],
              [
                 'name'=>'Revisar detalles con wedding planner.',
              ],
  
              [
                 'name'=>'Realiza una selección musical para tu fiesta.',
              ],
  
              [
                  'name'=>'Comienza a enviar tus invitaciones.',
               ],
               [
                 'name'=>'Enlista tus gastos extras y comienza a ordenarlos.',
              ],
  
              [
                 'name'=>'Comenzar con el papeleo de la boda civil.',
              ],
  
              [
                  'name'=>'Define fecha y hora de tu boda civil.',
               ],
               [
                 'name'=>'Comprar arras.',
              ],
  
              [
                 'name'=>'Prepara las maletas y detalles de tu noche de bodas.',
              ],
  
              [
                  'name'=>'Asegurate de que tus invitados confirmen su asistencia. ',
               ],
               [
                 'name'=>'Agenda una cita de prueba y ajustes para tu vestido de novia.',
              ],
  
              [
                 'name'=>'Prueba del traje de novio. ',
              ],
  
              [
                  'name'=>'Realiza tu acomodo de mesas.',
               ],
               [
                 'name'=>'Elegir menú.',
              ],
  
              [
                 'name'=>'Elegir tu ramo de novia.',
              ],
  
              [
                  'name'=>'Reservar el carro de novios.',
               ],
               [
                 'name'=>'Contrata el servicio para tu pastel de bodas.',
              ],
  
              [
                 'name'=>'Recoger vestido de novia y traje del novio.',
              ],
  
              [
                  'name'=>'Liquidar últimos gastos',
               ],
               [
                 'name'=>'Cita para prueba de maquillaje y peinado',
              ],
  
              [
                 'name'=>'Definir detalles de su despedida de solteros',
              ],
  
              [
                  'name'=>'Comparte con tu wedding planner tu control de invitados',
               ],
               [
                 'name'=>'Cita en el spa y barberia',
              ],
  
              [
                 'name'=>'¡A disfrutar su despedida de solteros!',
              ],
  
              [
                  'name'=>'Preparar un kit de emergencias.',
               ],
               [
                 'name'=>'El día de tu boda.',
              ]

        ];

        foreach ($tasks as $key => $value) {
            Task::create($value);
        } //
    }
}

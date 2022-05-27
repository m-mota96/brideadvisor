<?php

use Illuminate\Database\Seeder;
use App\CategoryProvider;
class CategoryProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
            'name'=>'Banquete y Catering',
            ],

            [
            'name'=>'Carro de Novios',
            ],

            [
                'name'=>'Flores y Decoración',
            ],

            [
                'name'=>'Foto y Video',
            ],

            [
                'name'=>'Hogar',
            ],

            [
                'name'=>'Hoteles',
            ],

            [
                'name'=>'Invitaciones',
            ],

            [
                'name'=>'Joyería',
            ],

            [
                'name'=>'Lugar de eventos',
            ],

            [
                'name'=>'Maquillaje y Peinado',
            ],

            [
                'name'=>'Mobiliario',
            ],

            [
                'name'=>'Música y Producción',
            ],

            [
                'name'=>'Repostería',
            ],

            [
                'name'=>'Ropa de etiqueta',
            ],

            [
                'name'=>'Salud y Belleza',
            ],

            [
                'name'=>'Souvenirs',
            ],

            [
                'name'=>'Vestidos',
            ],

            [
                'name'=>'Viajes',
            ],

            [
                'name'=>'Wedding planner',
            ],

            [
                'name'=>'Lencería',
            ],

        ];

        foreach ($category as $key => $value) {

            CategoryProvider::create($value);

        }
    }
}

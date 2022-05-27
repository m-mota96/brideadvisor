<?php

use Illuminate\Database\Seeder;
use App\Expense;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
                [
                    'concept'=>'Ceremonia',
                ],

                [
                    'concept'=>'Salón de eventos',
                ],
                [
                    'concept'=> 'Decoración floral',
                ],
                [
                    'concept'=> 'Fotografía y video',
                ],
                [
                    'concept'=> 'Banquete',
                ],
                [
                    'concept'=>'Wedding Planner',
                ],
                [
                    'concept'=>'Vestido de Novia',
                ],
                [
                    'concept'=>'Música en vivo',
                ],
                [
                    'concept'=>'Audio e iluminación',
                ],
                [
                    'concept'=>'Catering',
                ],
                [
                    'concept'=>'Invitaciones',
                ],
                [
                    'concept'=>'Maquillaje y peinado',
                ],
                [
                    'concept'=>'Carro de Novios',
                ],
                [
                    'concept'=>'Traje de novio',
                ],
                [
                    'concept'=>'Accesorios de novia',
                ],
                [
                    'concept'=>'Accesorios de novio',
                ],
                [
                    'concept'=>'Joyería',
                ],
                [
                    'concept'=>'Recuerdos o souvenirs',
                ],
                [
                    'concept'=>'Noche de bodas',
                ],
                [
                    'concept'=>'Luna de miel',
                ],
            ];

        foreach ($expenses as $key => $value) {
            Expense::create($value);
        } //
    }
}

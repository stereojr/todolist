<?php

use Illuminate\Database\Seeder;

class TodosSeederDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<=100; $i++)
        {
        	DB::table('todos')->insert([
        		'list_konten' 	=> 'Todo List ' . $i
        	]);
        }
    }
}

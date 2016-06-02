<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $endpoint = App\Endpoint::where('name', 'Live')->firstOrFail();

        DB::table('parameters')->insert([
            [
                'name' => 'relationId',
                'fixedValue' => '53689',
                'endpointId' => $endpoint->id
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $endpoint = App\Endpoint::where('name', 'Live')->firstOrFail();
        $modification = App\Modification::where('name', 'test_01')->firstOrFail();

        DB::table('responses')->insert([
            [
                'endpointId' => $endpoint->id,
                'modificationId' => $modification->id
            ],
        ]);
    }
}

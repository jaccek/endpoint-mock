<?php

use Illuminate\Database\Seeder;

class EndpointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sfProj = \App\Project::where('name', 'SportoweFakty')->firstOrFail();
        $sfId = $sfProj->id;

        DB::table('endpoints')->insert([
            [
                'name' => 'Live',
                'originalUrl' => 'http://sportowefakty.wp.pl/api/v1/relation/{relationId}',
                'httpMethod' => 'GET',
                'delay' => 0,
                'projectId' => $sfId
            ],
        ]);
    }
}

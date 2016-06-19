<?php

use Illuminate\Database\Seeder;

class ModificationsTableSeeder extends Seeder
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

        DB::table('modifications')->insert([
            [
                'name' => 'test_01',
                'path' => 'info.liveId',
                'value' => '{"data":"test"}',
                'projectId' => $sfId
            ],
            [
                'name' => 'test_02',
                'path' => 'info.discipline',
                'value' => '{"data":"test"}',
                'projectId' => $sfId
            ],
        ]);
    }
}

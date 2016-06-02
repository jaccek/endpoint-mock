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
        DB::table('modifications')->insert([
            [
                'name' => 'test_01',
                'type' => 1,
                'path' => 'info.liveId',
                'value' => '{"data":"test"}'
            ],
        ]);
    }
}

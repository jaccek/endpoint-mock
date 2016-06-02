<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responses')->delete();
        DB::table('modifications')->delete();
        DB::table('parameters')->delete();
        DB::table('endpoints')->delete();
        DB::table('projects')->delete();

        $this->call(ProjectsTableSeeder::class);
        $this->call(EndpointsTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        $this->call(ModificationsTableSeeder::class);
        $this->call(ResponsesTableSeeder::class);
    }
}

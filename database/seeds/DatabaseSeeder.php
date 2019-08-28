<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('cache:clear');
        $this->command->call('queue:flush');
        $this->command->call('queue:restart');
        File::cleanDirectory(storage_path('app/public'));
        config()->set('medialibrary.queued_conversions', true);
        $this->call(SettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SimplePagesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}

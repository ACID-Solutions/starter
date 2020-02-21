<?php

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        // todo : create needed users
        $this->createUser([
            'first_name' => 'Admin',
            'last_name' => 'STARTER',
            'email' => 'admin@starter.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('secret'),
        ]);
    }

    /**
     * @param array $data
     * @SuppressWarnings("unused")
     */
    public function createUser(array $data)
    {
        $user = (new User)->create($data);
        $user->addMedia(database_path('seeds/files/users/default-450-450.png'))
            ->preservingOriginal()
            ->toMediaCollection('avatars');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Users
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],


            // Customer
            ['name' => 'customer.view'],
            ['name' => 'customer.create'],
            ['name' => 'customer.update'],
            ['name' => 'customer.delete'],


            // Currency
            ['name' => 'currency.view'],
            ['name' => 'currency.create'],
            ['name' => 'currency.update'],
            ['name' => 'currency.delete'],

        ];

        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        Permission::insert($insert_data);
        Role::create([
            'name' => 'Super-Admin',
            'guard_name' => 'web',
        ]);

        $user = User::where('id', 1)->first();
        $user->assignRole('Super-Admin');
    }
}

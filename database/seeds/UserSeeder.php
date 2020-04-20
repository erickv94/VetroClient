<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 //Admin
        Role::create([
            "name"=>"Administrador",
            "slug"=>"admin",
            "description"=>" Administrador con ciertos permisos en el sistema",
            "special"=> "all-access",
        ]);
    	 User::create(
            [
            'name' => 'admin',
            'username'=>'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
    	#user reals
        User::create(
            [
            'name' => 'Bogdan',
            'username'=>'bogdan',
            'email' => 'bogdan.petreanu@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
        User::create(
            [
            'name' => 'Coca',
            'username'=>'coca',
            'email' => 'coca.cascaval@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
        User::create(
            [
            'name' => 'Andrei',
            'username'=>'andrei',
            'email' => 'andrei.prajina@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
        User::create(
            [
            'name' => 'Dumitru',
            'username'=>'dumitru',
            'email' => 'dumitru.fodor@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
        #other users
        User::create(
            [
            'name' => 'Dragos',
            'username'=>'dragos',
            'email' => 'dragos.cojocaru@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.image.edit',
        	'products.index'
        );
        User::create(
            [
            'name' => 'Madalin',
            'username'=>'madalin',
            'email' => 'madalin.chelaru@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.image.edit',
        	'products.index'
        );
        User::create(
            [
            'name' => 'Ana Maria',
            'username'=>'anamaria',
            'email' => 'anamaria.epure@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.text.edit',
        	'products.index'
        );
        User::create(
            [
            'name' => 'Diana',
            'username'=>'diana',
            'email' => 'diana.elisei@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.text.edit',
        	'products.index'
        );
        User::create(
            [
            'name' => 'Elena',
            'username'=>'elena',
            'email' => 'elena.troia@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.text.edit',
        	'products.index'
        );
        User::create(
            [
            'name' => 'Radu',
            'username'=>'radu',
            'email' => 'radu.cucuteanu@gmail.com',
            'email_verified_at' => now(),
            'password' =>Hash::make("secret") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.text.edit',
        	'products.index'
        );


    }
}

<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

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
            "description"=>" Administrador con ciertos permisos en el sistema"
        ])->givePermissionTo(
        	'products.index', 
        	'products.edit.text',
        	'products.insert.image',
        	'products.insert.watermark',
        	'products.edit.image',
        	'users.index',
        	'users.show',
        	'users.show.log',
        	'users.edit'
        );
    	 User::create(
            [
            'name' => 'admin',
            'username'=>'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
    	#user reals
        User::create(
            [
            'name' => 'Bogdan',
            'username'=>'Bogdan',
            'email' => 'bogdan.petreanu@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
         User::create(
            [
            'name' => 'Dumitru',
            'username'=>'dumitru',
            'email' => 'dumitru.fodor@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->assignRoles('admin');
        #create other users
        User::create(
            [
            'name' => 'Ana Maria',
            'username'=>'anaMaria',
            'email' => 'anamaria.epure@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.edit.text', 
        	'products.insert.image'
        );
        User::create(
            [
            'name' => 'Diana Elisei',
            'username'=>'dianaElisei',
            'email' => 'diana.elisei@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.edit.text', 
        	'products.insert.image'
        );
        User::create(
            [
            'name' => 'Elena',
            'username'=>'elena',
            'email' => 'elena.troia@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.edit.text', 
        	'products.insert.image'
        );
        User::create(
            [
            'name' => 'Radu',
            'username'=>'radu',
            'email' => 'radu.cucuteanu@gamil.com',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.edit.text', 
        	'products.insert.image'
        );
        User::create(
            [
            'name' => 'Dragos',
            'username'=>'dragos',
            'email' => 'dragos.cojocaru@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
        	'products.edit.image', 
        	'products.insert.watermark'
        );
        User::create(
            [
            'name' => 'Madalin',
            'username'=>'madalin',
            'email' => 'madalin.chelaru@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
            'products.edit.image', 
            'products.insert.watermark'
        );
        User::create(
            [
            'name' => 'George',
            'username'=>'George',
            'email' => 'george.onofrei@we-go.ro',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
            'users.show.log'
        );
        User::create(
            [
            'name' => 'Coca',
            'username'=>'Coca',
            'email' => 'cocoa.cascaval@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
            'users.show.log'
        );
        User::create(
            [
            'name' => 'Andrei',
            'username'=>'Andrei',
            'email' => 'andrei.prajina@vetro.vet',
            'email_verified_at' => now(),
            'password' =>Hash::make("vetro") , // password
            'remember_token' => Str::random(10),
            ]
        )->givePermissionTo(
            'users.show.log'
        );
    }
}

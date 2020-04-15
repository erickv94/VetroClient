<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list
    	#permisssion products
        Permission::create([
	        'name' => 'products.index',
	        "slug"=>"products.index",
	        'description' => 'Permission to see all products'
        ]); #1
        Permission::create([
	        'name' => 'products.edit.text',
	        "slug"=>"products.edit.text",
	        'description' => 'Permission to edit products'
        ]); #2
        Permission::create([
	        'name' => 'products.insert.image',
	        "slug"=>"products.insert.image",
	        'description' => 'Permission to insert an image'
        ]); #3
        Permission::create([
	        'name' => 'products.insert.watermark',
	        "slug"=>"products.insert.watermark",
	        'description' => 'Permission to insert a watermark to images'
        ]); #4
        Permission::create([
        	'name' => 'products.edit.image',
        	"slug"=>"products.edit.image",
        	'description' => 'Permission to edit an image'
        ]);
        #permission users
        Permission::create([
	        'name' => 'users.index',
	        "slug"=>"users.index",
	        'description' => 'Permission to see all users'
        ]); #5
        Permission::create([
	        'name' => 'users.show',
	        "slug"=>"users.show",
	        'description' => 'Permission to create users'
        ]); #6
        Permission::create([
	        'name' => 'users.show.log',
	        "slug"=>"users.show.log",
	        'description' => 'Permission to see logs of users'
        ]); #7
        Permission::create([
	        'name' => 'users.edit',
	        "slug"=>"users.edit",
	        'description' => 'Permission to edit users'
        ]); #8

    }
}

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
	        'description' => 'see all products'
        ]);
        Permission::create([
	        'name' => 'products.text.edit',
	        "slug"=>"products.text.edit",
	        'description' => 'edit text'
        ]);
        Permission::create([
	        'name' => 'products.image.edit',
	        "slug"=>"products.image.edit",
	        'description' => 'edit image'
        ]);
        #permission logs
        Permission::create([
	        'name' => 'logs.check',
	        "slug"=>"logs.check",
	        'description' => 'check user logs'
        ]);
        #permission prices
        Permission::create([
	        'name' => 'prices.index',
	        "slug"=>"prices.index",
	        'description' => 'see prices'
        ]);
        Permission::create([
	        'name' => 'prices.edit',
	        "slug"=>"prices.edit",
	        'description' => 'edit price'
        ]);
        Permission::create([
	        'name' => 'scrape',
	        "slug"=>"scrape",
	        'description' => 'set urls to scrape'
        ]);


    }
}

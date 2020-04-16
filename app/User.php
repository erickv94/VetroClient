<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query,$q){
        if($q)
            $query->where('usuario', 'ILIKE',"%$q%")->orWhere('nombre', 'ILIKE',"%$q%");
    }


    public function scopeRol($query,$rol){
        if($rol)
            $query->whereHas('roles',function($q) use ($rol) {
                $q->where('slug',$rol);
            });
    }
    public function syncPermissions($permissions){
        $slugs = [];
        for ($i=0; $i<count($permissions); $i++ ) {
           array_push($slugs, $permissions[$i]["slug"]);
        };
        $this->givePermissionTo($slugs);
    }
}


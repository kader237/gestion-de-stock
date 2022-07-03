<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'tel',
        'ville',
        'prenom',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function isMagasinier(){
        if($this->isAdminExist()){
            return $this->admin->type == "magasinier";
        }
        return false;
    }

    function isAdmin(){
        if($this->isAdminExist()){
            return $this->admin->type == "admin";
        }
        return false;
    }

    function isChef(){
        if($this->isAdminExist()){
            return $this->admin->type == "chef";
        }
        return false;
    }
    function isAdminExist(){
        if($this->admin == null)
            return false;
        return $this->admin->exists();
    }
    public function admin(){
        return $this->hasOne(Personnel::class);
    }

    public function commandes(){
        return  $this->hasMany(Commande::class);
    }

}

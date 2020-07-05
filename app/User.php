<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission) {
        return $this->role->permissions()->where('name', $permission)->first() ?: false;
    }

    public function isAdmin()
    {
        if($this->role->name == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    public function tasks()
    {
    	return $this->hasMany('App\Task');
    }

    public function ownTask(Task $task)
    {
        return auth()->id() === $task->user->id;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table = 'users_admins'; // 👈 هذا هو الحل

    public $timestamps = false; // إذا ما كنت تستخدم created_at و updated_at

    protected $fillable = ['name', 'username', 'password', 'role'];
}

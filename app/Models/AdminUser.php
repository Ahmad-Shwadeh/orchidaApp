<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table = 'users_admins'; // اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    public $timestamps = true; // إذا كنت تستخدم الحقول created_at و updated_at
}

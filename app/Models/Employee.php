<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees'; // تأكيد اسم الجدول إذا كان مختلف عن الكلاس
    protected $fillable = ['name', 'username', 'password', 'role'];




    public $timestamps = true; // إذا كنت تستخدم الحقول created_at و updated_at
    
}

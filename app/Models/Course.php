<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses'; // اسم الجدول

    protected $primaryKey = 'course_number'; // اسم المفتاح الأساسي

    public $incrementing = false; // لأنه مش auto increment

    protected $fillable = [
        'course_number',
        'name',
        'hours',
        'description',
    ];

    public $timestamps = false; // لو ما عندك created_at و updated_at
}

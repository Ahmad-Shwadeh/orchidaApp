<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students'; // اسم الجدول

    protected $primaryKey = 'student_id'; // المفتاح الأساسي
    public $incrementing = false; // مش تلقائي
    protected $keyType = 'string'; // نوع المفتاح نصي (تغيره لو رقمي)

    public $timestamps = false; // ما في created_at و updated_at

    protected $fillable = [
        'student_id',
        'name',
        'phone',
        'course_number',
        'section_id',
        'status',
        'notes'
    ];
    
}

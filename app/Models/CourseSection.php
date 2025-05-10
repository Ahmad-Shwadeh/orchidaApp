<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $primaryKey = 'section_id';
    public $timestamps = false;

    protected $fillable = [
        'course_number',
        'section_id',
        'start_date',
        'room_number',
        'instructor_name',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_number', 'course_number');
    }
}

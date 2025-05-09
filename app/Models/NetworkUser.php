<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetworkUser extends Model
{
    // المفتاح الأساسي هو username
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    // الأعمدة القابلة للتعبئة
    protected $fillable = [
        'username',
        'status',
        'assigned_to',
        'assigned_at',
        'last_update',
        'attachment', // ✅ تم إضافته
    ];

    // لا يوجد timestamps
    public $timestamps = false;
}

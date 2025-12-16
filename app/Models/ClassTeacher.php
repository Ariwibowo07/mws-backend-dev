<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassTeacher extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'class_teachers';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'class_id',
        'teacher_id',
        'role',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    /**
     * Relasi ke model Class (Kelas)
     */
    public function class()
    {
        return $this->belongsTo(Clasess::class, 'class_id');
    }

    /**
     * Relasi ke model User (Guru)
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}

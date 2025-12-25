<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';

    // PK sesuai migration
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'photo_id',
        'name',
        'gender',
        'student_mws_email',
        'grade',
        'tier',
        'type',
        'join_academic_year',
        'class_name',
        'nisn',
        'status',
        'mentor_id',
        'strategy',
        'progress_status',
    ];

    protected static function booted()
    {
        static::creating(function ($student) {
            if (empty($student->id)) {
                $student->id = (string) Str::uuid();
            }
        });
    }

    /* ================= RELATIONS ================= */

    // mentor_id → users.uuid
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'uuid');
    }

    public function interventions()
    {
        return $this->hasMany(InterventionAssignment::class, 'student_id', 'id');
    }

    public function emotionalCheckins()
    {
        return $this->hasMany(EmotionalCheckin::class, 'student_id', 'id');
    }
}

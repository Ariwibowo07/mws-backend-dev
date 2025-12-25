<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'class_id',
        'role',
        'supervisor_id',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /* ================= RELATIONS ================= */

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_uuid', 'uuid');
    }

    // user sebagai mentor
    public function students()
    {
        return $this->hasMany(Student::class, 'mentor_id', 'uuid');
    }

    public function teachingClasses()
    {
        return $this->belongsToMany(
            Clasess::class,
            'class_teachers',
            'teacher_uuid',
            'class_uuid'
        )->withPivot(['role'])->withTimestamps();
    }

    // ======= RELASI YANG MENGGUNAKAN students.id =======

    public function assessmentResponses()
    {
        return $this->hasMany(AssessmentResponse::class, 'student_id', 'uuid');
        // ⚠️ kalau ini seharusnya student → pindahkan ke Student model
    }

    public function baselineReports()
    {
        return $this->hasMany(BaselineReport::class, 'student_id', 'uuid');
    }

    public function interventionAssignments()
    {
        return $this->hasMany(InterventionAssignment::class, 'student_id', 'uuid');
    }
}

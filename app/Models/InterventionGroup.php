<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterventionGroup extends Model
{
    protected $fillable = [
        'group_name',
        'description',
        'created_by',
        'uuid',
        'uuid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'intervention_group_students',
            'intervention_group_uuid', // FK untuk group
            'student_uuid',            // FK untuk student
            'uuid',                    // local key di intervention_groups
            'uuid'                     // local key di students
        );
    }
}

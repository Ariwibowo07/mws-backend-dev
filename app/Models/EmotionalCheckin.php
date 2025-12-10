<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmotionalCheckin extends Model
{
    use HasFactory;

    protected $table = 'emotional_checkins';

    protected $primaryKey = 'id';   // ← WAJIB, ini penyebab error
    public $incrementing = false;   // UUID
    protected $keyType = 'string';  // UUID string

    protected $fillable = [
        'id',
        'user_id',
        'role',
        'mood',
        'internal_weather',
        'presence_level',
        'capasity_level',
        'note',
        'checked_in_at',
        'energy_level',
        'balance',
        'load',
        'readiness',
        'contact_id',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
        'presence_level' => 'integer',
        'capasity_level' => 'integer',
        'mood' => 'array',
        'note' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            if (empty($model->contact_id)) {
                $model->contact_id = 'no_need';
            }
        });

        static::updating(function ($model) {
            if (empty($model->contact_id)) {
                $model->contact_id = 'no_need';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id', 'id');
    }

    public function getContactInfoAttribute()
    {
        if ($this->contact_id === 'no_need') {
            return ['id' => 'no_need', 'name' => 'No Need'];
        }

        $contact = $this->contact()->first();
        return $contact ? ['id' => $contact->id, 'name' => $contact->name] : null;
    }

    public function getMoodLabelAttribute()
    {
        $moods = (array) $this->mood;

        $labels = array_map(function ($mood) {
            return match ($mood) {
                'very_happy' => '😊 Very Happy',
                'happy' => '🙂 Happy',
                'neutral' => '😐 Neutral',
                'sad' => '😢 Sad',
                'stressed' => '😣 Stressed',
                'angry' => '😡 Angry',
                default => ucfirst($mood),
            };
        }, $moods);

        return implode(', ', $labels);
    }
}


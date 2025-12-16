<?php

namespace App\Services;

use App\Models\Intervention;

class InterventionService
{
    public function createIntervention(array $data)
    {
        return Intervention::create($data);
    }
}

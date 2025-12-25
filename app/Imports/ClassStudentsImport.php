<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class StudentsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip header
        $rows->shift();

        // Ambil teacher by name (contoh Ms. Nana)
        $defaultMentor = Teacher::where('name', 'Ms. Nana')->first();

        foreach ($rows as $row) {
            // Sesuaikan index dengan CSV kamu
            $studentName = trim($row[0] ?? null);
            $className   = trim($row[1] ?? null);

            if (!$studentName || !$className) {
                continue;
            }

            Student::updateOrCreate(
                [
                    'student_name' => $studentName,
                    'class_name'   => $className,
                ],
                [
                    'mentor_id'       => $defaultMentor?->id,
                    'tier'            => 'tier_1',
                    'status'          => 'intervention',
                    'progress_status' => 'on_track',
                ]
            );
        }
    }
}

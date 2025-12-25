<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $teachers = [
                ['name' => 'Ms. Latifah', 'email' => 'latifah@millennia21.id'],
                ['name' => 'Ms. Kholida', 'email' => 'kholida@millennia21.id'],
                ['name' => 'Mr. Aria', 'email' => 'aria@millennia21.id'],
                ['name' => 'Ms. Hana', 'email' => 'hana.fajria@millennia21.id'],
                ['name' => 'Ms. Wina', 'email' => 'wina@millennia21.id'],
                ['name' => 'Ms.afiyanti ', 'email' => 'afiyanti.hardiansari@millennia21.id'],
                ['name' => 'Ms. Nana', 'email' => 'nana@millennia21.id'],
                ['name' => 'Ms. Devi', 'email' => 'devi.agriani@millennia21.id'],
                ['name' => 'Ms. diya', 'email' => 'diya@millennia21.id'],
                ['name' => 'Ms. eva', 'email' => 'fransiskaeva@millennia21.id'],
                ['name' => 'Ms. gundah', 'email' => 'gundah@millennia21.id'],
                ['name' => 'Pak. Hadi', 'email' => 'hadi@millennia21.id'],
                ['name' => 'pak. Himawan', 'email' => 'himawan@millennia21.id'],
                ['name' => 'Ms. alys', 'email' => 'alys@millennia21.id'],
                ['name' => 'Ms. maria', 'email' => 'maria@millennia21.id'],
                ['name' => 'Ms. nadia', 'email' => 'nadiamws@millennia21.id'],
                ['name' => 'Ms. nanda', 'email' => 'nanda@millennia21.id'],
                ['name' => 'Ms. thasya', 'email' => 'nathasya@millennia21.id'],
                ['name' => 'Ms. novia', 'email' => 'novia@millennia21.id'],
                ['name' => 'Ms. widya', 'email' => 'widya@millennia21.id'],
                ['name' => 'Ms.pipiet', 'email' => 'pipiet@millennia21.id'],
                ['name' => 'Ms. cecil', 'email' => 'cecil@millennia21.id'],
                ['name' => 'Ms. Putri', 'email' => 'putri.fitriyani@millennia21.id'],
                ['name' => 'Ms. raisa', 'email' => 'raisa@millennia21.id'],
                ['name' => 'pak. rifki', 'email' => 'rifqi.satria@millennia21.id'],
                ['name' => 'Ms. angel', 'email' => 'risma.angelita@millennia21.id'],
                ['name' => 'Ms. Risma', 'email' => 'risma.galuh@millennia21.id'],
                ['name' => 'Ms. kiki', 'email' => 'rizkinurul@millennia21.id'],
                ['name' => 'pak. robby', 'email' => 'robby.noer@millennia21.id'],
                ['name' => 'Ms. ayu', 'email' => 'triayulestari@millennia21.id'],
                ['name' => 'Ms. fadilla', 'email' => 'triafadilla@millennia21.id'],
                ['name' => 'Pak Vicki', 'email' => 'vickiaprinando@millennia21.id'],
                ['name' => 'Ms. yohana', 'email' => 'yohana@millennia21.id'],
                ['name' => 'Ms. oudy', 'email' => 'oudy@millennia21.id'],
                ['name' => 'Ms. zolla', 'email' => 'zolla@millennia21.id'],
                ['name' => 'Ms. chaca', 'email' => 'chaca@millennia21.id'],
                ['name' => 'Ms. sisil', 'email' => 'sisil@millennia21.id'],
                ['name' => 'Ms. nayandra', 'email' => 'nayandra@millennia21.id'],
            ];

            foreach ($teachers as $teacher) {
                Teacher::updateOrCreate(
                    ['email' => $teacher['email']],
                    ['name' => $teacher['name']]
                );
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

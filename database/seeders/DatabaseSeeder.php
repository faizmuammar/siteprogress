<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\TodoItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 3 Aktor Utama (ID 1, 2, 3)
        $pic = User::create([
            'name' => 'Ahmad Faiz Muammar (PIC)',
            'email' => 'pic@tigaciptaselaras.co.id',
            'password' => Hash::make('password'),
            'role' => 'pic_lapangan',
        ]);

        $ownerProyek = User::create([
            'name' => 'Bapak Hendra (Owner Proyek)',
            'email' => 'klien@jababeka.co.id',
            'password' => Hash::make('password'),
            'role' => 'owner_proyek',
        ]);

        $ownerTcs = User::create([
            'name' => 'Direktur PT Tiga Cipta Selaras',
            'email' => 'direktur@tigaciptaselaras.co.id',
            'password' => Hash::make('password'),
            'role' => 'owner_tcs',
        ]);

        // 2. Buat Proyek Utama (ID = 1)
        $project = Project::create([
            'code' => 'PRJ-TCS-001',
            'title' => 'Pembangunan Pabrik Manufaktur Zonal A',
            'client_name' => 'PT Jababeka Indah',
            'location' => 'Kawasan Industri Cikarang',
            'progress_percentage' => 82.50,
            'status' => 'On Track',
            'start_date' => '2026-06-01',
            'target_completion_date' => '2026-12-15',
            'owner_user_id' => $ownerProyek->id,
            'pic_user_id' => $pic->id,
        ]);

        // 3. Buat Daftar Milestone / To-Do Awal
        TodoItem::create(['project_id' => $project->id, 'task_name' => 'Pengeboran Pondasi Bored Pile', 'is_completed' => true]);
        TodoItem::create(['project_id' => $project->id, 'task_name' => 'Pemasangan Rangka Baja Utama', 'is_completed' => true]);
        TodoItem::create(['project_id' => $project->id, 'task_name' => 'Pemasangan Atap ZincAlum', 'is_completed' => false]);
        TodoItem::create(['project_id' => $project->id, 'task_name' => 'Finishing Epoxy Floor', 'is_completed' => false]);
    }
}
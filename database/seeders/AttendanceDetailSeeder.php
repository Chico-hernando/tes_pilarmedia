<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_detail')->delete();

        DB::table('attendance_detail')->insert([[
            'name' => "Masuk",
            'created_at' => now()
        ],[
            'name' => "Tidak Masuk",
            'created_at' => now()
        ],[
            'name' => "Tidak Valid",
            'created_at' => now()
        ],[
            'name' => "Izin Cuti (Belum Diapprove)",
            'created_at' => now()
        ],[
            'name' => "Izin Cuti",
            'created_at' => now()
        ],[
            'name' => "Cuti Ditolak",
            'created_at' => now()
        ],[
            'name' => "Izin Sakit",
            'created_at' => now()
        ]
        ]);
    }
}

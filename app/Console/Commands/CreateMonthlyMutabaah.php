<?php

namespace App\Console\Commands;

use App\Models\Mutabaah;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateMonthlyMutabaah extends Command
{
    protected $signature = 'mutabaah:create-monthly';

    protected $description = 'Buat mutabaah bulanan otomatis';

    public function handle()
    {
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $months[$currentMonth];
        $name = "Mutabaah {$monthName} {$currentYear}";

        $exists = Mutabaah::where('name', $name)->exists();

        if ($exists) {
            $this->info("Mutabaah {$name} sudah ada.");

            return Command::SUCCESS;
        }

        $start = $now->copy()->day(28)->format('Y-m-d');
        $end = $now->copy()->addMonth()->day(20)->format('Y-m-d');

        Mutabaah::create([
            'name' => $name,
            'start' => $start,
            'end' => $end,
        ]);

        $this->info("Mutabaah {$name} berhasil dibuat.");

        return Command::SUCCESS;
    }
}

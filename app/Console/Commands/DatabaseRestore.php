<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseRestore extends Command
{
    protected $signature = 'db:restore {file : Nama file backup (.sql)}';

    protected $description = 'Restore database dari file backup';

    public function handle()
    {
        $filename = $this->argument('file');
        $filepath = storage_path("backups/{$filename}");

        if (! File::exists($filepath)) {
            $this->error("File tidak ditemukan: {$filepath}");

            return Command::FAILURE;
        }

        $sql = File::get($filepath);
        $statements = explode(';', $sql);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (! empty($statement) && strpos($statement, 'INSERT INTO') === 0) {
                try {
                    DB::unprepared($statement);
                } catch (\Exception $e) {
                    $this->warn('Gagal menjalankan: '.substr($statement, 0, 50).'...');
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info("Restore berhasil dari: {$filename}");

        return Command::SUCCESS;
    }
}

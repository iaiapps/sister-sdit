<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup {--path= : Custom path untuk backup}';

    protected $description = 'Backup seluruh database';

    public function handle()
    {
        $dbName = config('database.connections.mysql.database');
        $path = $this->option('path') ?? storage_path('backups');
        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filename = "{$dbName}_".Carbon::now()->format('Y-m-d_His').'.sql';
        $filepath = "{$path}/{$filename}";

        $sql = $this->generateSql();

        if (File::put($filepath, $sql) !== false) {
            $this->info("Backup berhasil: {$filename}");
            $this->cleanupOldBackups($path);

            return Command::SUCCESS;
        }

        $this->error('Backup gagal');

        return Command::FAILURE;
    }

    private function generateSql()
    {
        $sql = '';
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];
            $sql .= "\n\n-- Table {$tableName}\n";
            $sql .= "DROP TABLE IF EXISTS {$tableName};\n";

            $create = DB::select("SHOW CREATE TABLE {$tableName}")[0];
            $sql .= $create->{'Create Table'}.";\n\n";

            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $values = [];
                foreach ($row as $value) {
                    $values[] = is_null($value) ? 'NULL' : "'".addslashes($value)."'";
                }
                $columns = implode(', ', array_keys((array) $row));
                $vals = implode(', ', $values);
                $sql .= "INSERT INTO {$tableName} ({$columns}) VALUES ({$vals});\n";
            }
        }

        return $sql;
    }

    private function cleanupOldBackups($path, $keepDays = 30)
    {
        $files = File::files($path);
        $cutoff = Carbon::now()->subDays($keepDays);

        foreach ($files as $file) {
            if (File::lastModified($file) < $cutoff->timestamp) {
                File::delete($file);
                $this->info('Deleted old backup: '.$file->getFilename());
            }
        }
    }
}

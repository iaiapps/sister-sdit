<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        $path = storage_path('backups');
        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $files = File::files($path);
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'filename' => $file->getFilename(),
                'size' => $file->getSize(),
                'date' => Carbon::createFromTimestamp(File::lastModified($file)),
            ];
        }

        usort($backups, function ($a, $b) {
            return $b['date']->timestamp - $a['date']->timestamp;
        });

        return view('admin.setting.backup.index', compact('backups'));
    }

    public function backup()
    {
        $dbName = config('database.connections.mysql.database');
        $path = storage_path('backups');

        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filename = $dbName.'_'.Carbon::now()->format('Y-m-d_His').'.sql';
        $filepath = "{$path}/{$filename}";

        $sql = $this->generateSql();

        if (File::put($filepath, $sql) !== false) {
            return redirect()->route('admin.setting.backup.index')->with('success', "Backup berhasil: {$filename}");
        }

        return redirect()->route('admin.setting.backup.index')->with('error', 'Backup gagal');
    }

    public function download($filename)
    {
        $filepath = storage_path("backups/{$filename}");

        if (! File::exists($filepath)) {
            return redirect()->route('admin.setting.backup.index')->with('error', 'File tidak ditemukan');
        }

        return response()->download($filepath, $filename);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:sql,txt',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = storage_path('backups');

        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filepath = "{$path}/{$filename}";
        $file->move($path, $filename);

        try {
            $sql = File::get($filepath);

            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $statements = array_filter(array_map('trim', explode(';', $sql)));

            foreach ($statements as $statement) {
                if (! empty($statement) && strpos($statement, 'INSERT INTO') !== false) {
                    try {
                        DB::unprepared($statement);
                    } catch (\Exception $e) {
                        // skip individual insert errors
                    }
                }
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            File::delete($filepath);

            return redirect()->route('admin.setting.backup.index')->with('success', 'Restore berhasil');
        } catch (\Exception $e) {
            File::delete($filepath);

            return redirect()->route('admin.setting.backup.index')->with('error', 'Restore gagal: '.$e->getMessage());
        }
    }

    public function delete($filename)
    {
        $filepath = storage_path("backups/{$filename}");

        if (File::exists($filepath)) {
            File::delete($filepath);

            return redirect()->route('admin.setting.backup.index')->with('success', 'File backup dihapus');
        }

        return redirect()->route('admin.setting.backup.index')->with('error', 'File tidak ditemukan');
    }

    private function generateSql()
    {
        $sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";

        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map(fn ($t) => array_values((array) $t)[0], $tables);

        foreach ($tableNames as $tableName) {
            $sql .= "\n-- Table {$tableName}\n";

            $create = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $create->{'Create Table'}.";\n\n";

            $rows = DB::table($tableName)->get();
            if ($rows->count() > 0) {
                foreach ($rows as $row) {
                    $values = [];
                    foreach ($row as $key => $value) {
                        $values[] = is_null($value) ? 'NULL' : "'".addslashes($value)."'";
                    }
                    $columns = implode(', ', array_keys((array) $row));
                    $vals = implode(', ', $values);
                    $sql .= "INSERT INTO `{$tableName}` ({$columns}) VALUES ({$vals});\n";
                }
            }
        }

        $sql .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

        return $sql;
    }
}

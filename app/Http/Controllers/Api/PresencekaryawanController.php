<?php

namespace App\Http\Controllers\Api;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Presencekaryawan;
use App\Models\PresenceSetting;
use Illuminate\Support\Facades\Validator;

class PresencekaryawanController extends Controller
{
    // INI NORMAL
    public function index()
    {
        $data = Presencekaryawan::whereHas('teacher.user', function ($q) {
            $q->where('active', 1);
        })->get();
        return response()->json([
            'pesan' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $monthyear = Carbon::now();
        $presence = Presencekaryawan::where('teacher_id', $id)->whereYear('created_at', $monthyear)->whereMonth('created_at', $monthyear)->get();

        if ($presence->count() == null) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['pesan' => 'Data ditemukan', 'data' => $presence], 200);
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();
        return response()->json(['pesan' => 'Data berhasil dihapus'], 200);
    }


    public function store(Request $request)
    {

        if ($this->validateAndCheck($request) == true) {

            return $this->saveData($request);
        } else {
            return $this->absenPulang($request);
        }
    }


    // fungsi check request data
    public function validateAndCheck($request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'pesan' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 404);
        }
        $presence = Presencekaryawan::where('teacher_id', $request->teacher_id)
            ->whereDate('created_at', '=', Carbon::today()
                ->toDateString())
            ->first();

        if ($presence == null) {
            return true;
        } else {
            return false;
        }
    }

    // fungsi save data cek terlambat
    // public function saveData($request, $is_late)
    public function saveData($request)
    {

        $now = Carbon::now();

        $presence = Presencekaryawan::create([
            'teacher_id' => $request->teacher_id,
            'time_in' => $now->isoFormat('HH:mm:ss'),
            'time_out' => '-',

        ]);
        return response()->json([
            'pesan' => 'Berhasil absen masuk',
            'data' => $presence
        ], 200);
    }

    public function absenPulang($request)
    {
        // cek dulu takut ada note nya
        $presence = Presencekaryawan::where('teacher_id', $request->teacher_id)->orderBy('id', 'desc')->first();
        if ($presence->time_in == '-') {
            $presence->time_out = '-';
            $presence->save();
            return response()->json([
                'pesan' => 'Berhasil absen pulang',
                'data' => $presence
            ], 200);
        } else {
            Presencekaryawan::where('teacher_id', $request->teacher_id)
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->update(['time_out' => Carbon::now()->isoFormat('HH:mm:ss')]);
            return response()->json(['pesan' => 'Berhasil absen pulang', 'data' => Carbon::now()->isoFormat('HH:mm:ss')], 200);
        }
    }

    // ========== HELPER METHODS (ditambahkan, belum dipakai) ==========

    private function _settingValue($for)
    {
        return PresenceSetting::where('name', $for)->first()->value;
    }

    private function _timeline()
    {
        return $this->_settingValue('timeline') == '1';
    }

    private function _scannable()
    {
        $now = Carbon::now();
        $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
        $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));
        return $now->between($early_time_come, $end_time_leave);
    }

    private function _isLate()
    {
        $now = Carbon::now();
        $ontime = Carbon::createFromTimeString($this->_settingValue('ontime_until'));
        $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
        return !$now->between($early_time_come, $ontime);
    }

    private function _note($now, $teacher_id, $note, $description = null)
    {
        if (!in_array($note, ['Sakit', 'Ijin']) && empty($description)) {
            return response()->json([
                'pesan' => 'Keterangan belum diisi'
            ], 400);
        }

        $presence = Presencekaryawan::where('teacher_id', $teacher_id)
            ->whereDate('created_at', '=', Carbon::today())
            ->first();

        if (!$presence) {
            $data = [
                'teacher_id' => $teacher_id,
                'time_in' => ($note == 'Tugas kedinasan') ? $now : '-',
                'time_out' => '-',
                'is_late' => false,
                'note' => $note,
                'description' => $description,
            ];

            $presence = Presencekaryawan::create($data);
            return response()->json([
                'pesan' => "Berhasil menambahkan catatan $note",
                'data' => $presence
            ], 200);
        }

        if ($note == 'Pulang awal') {
            if ($presence->time_out !== '-') {
                return response()->json([
                    'pesan' => 'Presensi pulang sudah dicatat sebelumnya'
                ], 200);
            }

            $presence->time_out = $now;

            if ($presence->note == 'Telat') {
                $presence->note = 'Telat, Pulang awal';
            } elseif ($presence->note == 'Tepat waktu') {
                $presence->note = 'Tepat waktu, Pulang awal';
            } else {
                return response()->json([
                    'pesan' => 'Tidak diizinkan mengubah data'
                ], 200);
            }

            $presence->description = $description;
            $presence->save();

            return response()->json([
                'pesan' => 'Berhasil mencatat presensi pulang awal',
                'data' => $presence
            ], 200);
        }

        return response()->json([
            'pesan' => 'Data sudah ada, tidak diizinkan mengubah data'
        ], 200);
    }

    public function getVersionK()
    {
        $version = DB::table('presence_settings')->where('name', 'versionk')->first();
        return $version->value;
    }
}

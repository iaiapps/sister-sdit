<?php

namespace App\Http\Controllers\Api;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\Presencekaryawan;
use App\Models\PresenceSetting;
use Illuminate\Support\Facades\Validator;

class PresencekaryawanController extends Controller
{
    // INI NORMAL
    public function index()
    {
        $data = Presencekaryawan::get();
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
        // $now = Carbon::now()->isoFormat('HH:mm:ss');

        // if ($request->has('note')) {
        //     return $this->_note($request->teacher_id, $request->note, $request->description);
        // } else {
        // if ($this->_timeline() == true) {
        // if ($this->_scannable() == true) {
        if ($this->validateAndCheck($request) == true) {
            // $now = Carbon::now();
            // $early_time_leave = Carbon::createFromTimeString($this->_settingValue('early_time_leave'));
            // $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));
            // if ($now->between($early_time_leave, $end_time_leave)) {
            // return $this->scanLeaveOnly($request);
            // } else {
            // return $this->saveData($request, $this->_isLate());
            return $this->saveData($request);
            // }
        } else {
            return $this->absenPulang($request);
        }
        // } else {
        //     return response()->json(['pesan' => 'waktu scan tidak valid'], 404);
        // }
        // } else {
        //     if ($this->validateAndCheck($request) == true) {
        //         return $this->saveData($request, $this->_isLate());
        //     } else {
        //         Presencekaryawan::where('teacher_id', $request->teacher_id)
        //             ->whereDate('created_at', '=', Carbon::today()
        //                 ->toDateString())
        //             ->update(['time_out' => $now]);
        //         return response()->json(['pesan' => 'Berhasil absen pulang', 'data' => $now], 200);
        //     }
        // }
        // }
    }

    // fungsi note
    // private function _note($teacher_id, $note, $description)
    // {
    //     $presence = Presencekaryawan::where('teacher_id', $teacher_id)->whereDate('created_at', '=', Carbon::today())->first();
    //     if ($presence == null) {
    //         if ($note == 'Tugas kedinasan') {
    //             $presence = Presencekaryawan::create([
    //                 'teacher_id' => $teacher_id,
    //                 // 'date' => date("d/m/y"),
    //                 'time_in' => date('H:i:s'),
    //                 'time_out' => '-',
    //                 'is_late' => false,
    //                 'note' => $note,
    //                 'description' => $description
    //             ]);
    //         } else {
    //             $presence = Presencekaryawan::create([
    //                 'teacher_id' => $teacher_id,
    //                 // 'date' => date("d/m/y"),
    //                 'time_in' => '-',
    //                 'time_out' => '-',
    //                 'is_late' => false,
    //                 'note' => $note,
    //             ]);
    //         }
    //         $pesan = 'Berhasil menambahkan catatan ' . $note;
    //         return response()->json(['pesan' => $pesan, 'data' => $presence], 200);
    //     } else {
    //         return response()->json([
    //             'pesan' => 'Data sudah ada',
    //         ], 200);
    //     }
    // }

    //fungsi get setting value
    // private function _settingValue($for)
    // {
    //     return PresenceSetting::where('name', $for)->first()->value;
    // }

    //fungsi timeline
    // private function _timeline()
    // {
    //     if ($this->_settingValue('timeline') == '1') {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    //fungsi scannable
    // private function _scannable()
    // {
    //     $now = Carbon::now();
    //     $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
    //     $end_time_come = Carbon::createFromTimeString($this->_settingValue('end_time_come'));
    //     $early_time_leave = Carbon::createFromTimeString($this->_settingValue('early_time_leave'));
    //     $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));
    //     if ($now->between($early_time_come, $end_time_come)) {
    //         return true;
    //     } elseif ($now->between($early_time_leave, $end_time_leave)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // private function _isLate()
    // {
    //     $now = Carbon::now();
    //     $ontime = Carbon::createFromTimeString($this->_settingValue('ontime_until'));
    //     $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
    //     if ($now->between($early_time_come, $ontime)) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

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
        // if ($is_late == false) {
        //     $note = 'Tepat waktu';
        // } else {
        //     $note = 'Telat';
        // }

        $now = Carbon::now();

        $presence = Presencekaryawan::create([
            'teacher_id' => $request->teacher_id,
            // 'date' => date("d/m/y"),
            'time_in' => $now->isoFormat('HH:mm:ss'),
            'time_out' => '-',
            // 'is_late' => $is_late,
            // 'note' => $note
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
            //cek dulu, jika sdh ada, jangan absen lagi. nunggu waktu
            // $now = Carbon::now();
            // $early_time_leave = Carbon::createFromTimeString($this->_settingValue('early_time_leave'));
            // $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));
            // if ($now->between($early_time_leave, $end_time_leave)) {
            Presencekaryawan::where('teacher_id', $request->teacher_id)
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->update(['time_out' => Carbon::now()->isoFormat('HH:mm:ss')]);
            return response()->json(['pesan' => 'Berhasil absen pulang', 'data' => Carbon::now()->isoFormat('HH:mm:ss')], 200);
            // } else {
            //     return response()->json(['pesan' => 'Belum saatnya pulang'], 200);
            // }
        }
    }

    // public function scanLeaveOnly($request)
    // {
    //     $jamNow = Carbon::now()->isoFormat('HH:mm:ss');
    //     $end_time_come = Carbon::createFromTimeString($this->_settingValue('end_time_come'))->isoFormat('HH:mm:ss');
    //     $presence = Presencekaryawan::create([
    //         'teacher_id' => $request->teacher_id,
    //         // 'date' => date("d/m/y"),
    //         'time_in' => $end_time_come,
    //         'time_out' => $jamNow,
    //         'is_late' => 1,
    //         'note' => 'Telat'
    //     ]);
    //     return response()->json([
    //         'pesan' => 'Berhasil absen pulang',
    //         'data' => $presence
    //     ], 200);
    // }

    // public function getQrCodes()
    // {
    //     $qr = DB::table('presence_settings')->where('name', 'qrcode')->get();
    //     return response()->json([
    //         'pesan' => 'Berhasil mendapatkan kode qr-code',
    //         'data' => $qr
    //     ], 200);
    // }
    // public function getQrCode()
    // {
    //     $qr = DB::table('presence_settings')->where('name', 'qrcode')->first();
    //     return $qr->value;
    // }
    // public function getTimeSettings()
    // {
    //     $qr = DB::table('presence_settings')->where('name', '!=', 'qrcode')->get();
    //     return response()->json([
    //         'pesan' => 'Berhasil mendapatkan Settings',
    //         'data' => $qr
    //     ], 200);
    // }
    // public function jam()
    // {
    //     $jam = Carbon::now()->isoFormat('HH:mm:ss');
    //     return response()->json([
    //         'pesan' => 'Berhasil mendapatkan jam',
    //         'data' => $jam
    //     ]);
    // }
}

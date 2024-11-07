<?php

namespace App\Http\Controllers\Api;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\PresenceSetting;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    //get all data
    public function index()
    {
        $data = Presence::get();
        return response()->json([
            'pesan' => 'success',
            'data' => $data
        ], 200);
    }

    // get data by id
    public function show($id)
    {
        // dd($userInstance->tokens);

        $monthyear = Carbon::now();
        $presence = Presence::where('teacher_id', $id)->whereYear('created_at', $monthyear)->whereMonth('created_at', $monthyear)->orderBy('created_at', 'desc')->get();

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

    // INI BUTUH MIKIR DAN KERJA EXTRA wkwkw (perbaikan lagi)
    // step cek :
    // 1. note
    // 2. timeline
    // 3. scannable
    // 4. is_late

    // fungsi store data
    public function store(Request $request)
    {
        // parameter note
        $now = Carbon::now()->isoFormat('HH:mm:ss');
        $teacher_id = $request->teacher_id;
        $note = $request->note;
        $description = $request->description;

        if ($request->has('note')) { // jika ada note
            if ($this->_timeline() == true) {
                if ($this->_scannable() == true) {
                    return $this->_note($now, $teacher_id, $note, $description);
                } else {
                    return response()->json(['pesan' => 'Waktu presensi tidak valid'], 200);
                }
            } else {
                return $this->_note($now, $teacher_id, $note, $description);
            }
        } else { // jika tidak ada note
            if ($this->_timeline() == true) {
                if ($this->_scannable() == true) {
                    if ($this->validateAndCheck($request) == true) {
                        return $this->saveData($request, $this->_isLate());
                    } else {
                        return $this->absenPulang($request);
                    }
                } else {
                    return response()->json(['pesan' => 'Waktu presensi tidak valid'], 200);
                }
            } else {
                if ($this->validateAndCheck($request) == true) {
                    return $this->saveData($request, $this->_isLate());
                } else {
                    Presence::where('teacher_id', $request->teacher_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->update(['time_out' => $now]);
                    return response()->json(['pesan' => 'Berhasil presensi pulang', 'data' => $now], 200);
                }
            }
        }
    }

    //fungsi get setting value
    private function _settingValue($for)
    {
        return PresenceSetting::where('name', $for)->first()->value;
    }

    //fungsi timeline (pemabatasan waktu)
    private function _timeline()
    {
        if ($this->_settingValue('timeline') == '1') {
            return true;
        } else {
            return false;
        }
    }

    //fungsi scannable, bisa absen ketika waktu ini
    private function _scannable()
    {
        $now = Carbon::now();
        $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
        $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));
        if ($now->between($early_time_come, $end_time_leave)) {
            return true;
        } else {
            return false;
        }
    }

    // fungsi note
    private function _note($now, $teacher_id, $note, $description)
    {
        // get data presensi
        $presence = Presence::where('teacher_id', $teacher_id)->whereDate('created_at', '=', Carbon::today())->first();

        // $early_time_leave = Carbon::createFromTimeString($this->_settingValue('early_time_leave'));
        // $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));

        if ($presence == null) { // cek jika tidak ada data
            if ($note == 'Tugas kedinasan') {
                $presence = Presence::create([
                    'teacher_id' => $teacher_id,
                    'time_in' => $now,
                    'time_out' => '-',
                    'is_late' => false,
                    'note' => $note,
                    'description' => $description
                ]);
            } else {
                $presence = Presence::create([
                    'teacher_id' => $teacher_id,
                    'time_in' => '-',
                    'time_out' => '-',
                    'is_late' => false,
                    'note' => $note,
                ]);
            }
            $pesan = 'Berhasil menambahkan catatan ' . $note;
            return response()->json(['pesan' => $pesan, 'data' => $presence], 200);
        } elseif ($note == 'Pulang awal') {
            $presence->time_out = $now;
            if ($presence->note == 'Telat') {
                $presence->note = 'Telat, Pulang awal';
            } elseif ($presence->note == 'Tepat waktu') {
                $presence->note = 'Tepat waktu, Pulang awal';
            } else {
                return response()->json(['pesan' => 'Tidak diijinkan mengubah data'], 200);
            }
            $presence->description = $description;
            $presence->save();

            return response()->json(['pesan' => 'Berhasil presensi pulang awal'], 200);
        } else {
            return response()->json([
                'pesan' => 'Data sudah ada, tidak diijinkan mengubah data',
            ], 200);
        }
    }

    // fungsi waktu terlambat
    private function _isLate()
    {
        $now = Carbon::now();
        $ontime = Carbon::createFromTimeString($this->_settingValue('ontime_until'));
        $early_time_come = Carbon::createFromTimeString($this->_settingValue('early_time_come'));
        if ($now->between($early_time_come, $ontime)) {
            return false;
        } else {
            return true;
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
        $presence = Presence::where('teacher_id', $request->teacher_id)
            ->whereDate('created_at', '=', Carbon::today()->toDateString())->first();

        if ($presence == null) {
            return true;
        } else {
            return false;
        }
    }

    // fungsi save data dan cek keterlambatan
    public function saveData($request, $is_late)
    {
        if ($is_late == false) {
            $note = 'Tepat waktu';
        } else {
            $note = 'Telat';
        }
        $now = Carbon::now();

        $presence = Presence::create([
            'teacher_id' => $request->teacher_id,
            'time_in' => $now->isoFormat('HH:mm:ss'),
            'time_out' => '-',
            'is_late' => $is_late,
            'note' => $note
        ]);
        return response()->json([
            'pesan' => 'Berhasil presensi masuk',
            'data' => $presence
        ], 200);
    }

    public function absenPulang($request)
    {
        // cek jika ada note sakit, ijin, dan tugas kedinasan
        $presence = Presence::where('teacher_id', $request->teacher_id)->orderBy('id', 'desc')->first();
        if ($presence->time_in == '-' && $presence->time_out = '-') {
            return response()->json(['pesan' => 'tidak bisa mengubah data'], 200);
        } elseif ($presence->note == 'Tugas kedinasan') {
            return response()->json(['pesan' => 'Tidak bisa mengubah data'], 200);
        }

        $now = Carbon::now();
        $early_time_leave = Carbon::createFromTimeString($this->_settingValue('early_time_leave'));
        $end_time_leave = Carbon::createFromTimeString($this->_settingValue('end_time_leave'));

        //cek dulu, jika sdh ada data, jangan absen lagi, tunggu waktu absen
        if ($now->between($early_time_leave, $end_time_leave)) {
            Presence::where('teacher_id', $request->teacher_id)
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->update(['time_out' => Carbon::now()->isoFormat('HH:mm:ss')]);
            return response()->json(['pesan' => 'Berhasil presensi pulang', 'data' => Carbon::now()->isoFormat('HH:mm:ss')], 200);
        } else {
            return response()->json(['pesan' => 'Belum saatnya presensi pulang'], 200);
        }
    }

    // untuk get qr code
    public function getQrCode()
    {
        $qr = DB::table('presence_settings')->where('name', 'qrcode')->first();
        return $qr->value;
    }

    // Qr ini tidak digunakan
    // public function getQrCode()
    // {
    //     $qr = DB::table('presence_settings')->where('name', 'qrcode')->get();
    //     return response()->json([
    //         'pesan' => 'Berhasil mendapatkan data qr-code',
    //         'data' => $qr
    //     ], 200);
    // }

    public function getSettings()
    {
        $list = DB::table('presence_settings')->where(function ($query) {
            $query->where('name', '!=', 'qrcode')->where('name', '!=', 'end_time_come')->where('name', '!=', 'timeline');
        })->get();
        return response()->json([
            'pesan' => 'Berhasil mendapatkan data Settings',
            'data' => $list
        ], 200);
    }

    // belum digunakann
    public function jam()
    {
        $jam = Carbon::now()->isoFormat('HH:mm:ss');
        return response()->json([
            'pesan' => 'Berhasil mendapatkan data jam',
            'data' => $jam
        ]);
    }
}

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
        $monthyear = Carbon::now();
        $presence = Presence::where('teacher_id', $id)
            ->whereYear('created_at', $monthyear)
            ->whereMonth('created_at', $monthyear)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($presence->count() == null) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 200);
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

        // // Jika ada catatan (note)
        // if ($request->has('note')) {
        //     // Jika timeline diaktifkan, pastikan scannable valid
        //     if ($this->_timeline() && !$this->_scannable()) {
        //         return response()->json(['pesan' => 'Waktu presensi tidak valid'], 200);
        //     }

        //     return $this->_note($now, $teacher_id, $note, $description);
        // }

        // // Jika tidak ada note (presensi normal)
        // if ($this->_timeline() && !$this->_scannable()) {
        //     return response()->json(['pesan' => 'Waktu presensi tidak valid'], 200);
        // }

        // // Validasi kehadiran sebelumnya
        // if ($this->validateAndCheck($request)) {
        //     return $this->saveData($request, $this->_isLate());
        // } else {
        //     return $this->absenPulang($request);
        // }

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
    // mengembalikan true jika timeline == 1
    // dan false jika timeline != 1
    // lebih ringkas
    private function _timeline()
    {
        return $this->_settingValue('timeline') == '1';
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

    // fungsi catatan seperti sakit, ijin, tugas kedinasan, dan pulang awal
    private function _note($now, $teacher_id, $note, $description = null)
    {
        // Cek jika note dikirimkan tetapi description kosong
        // Jika note bukan "Sakit" atau "Ijin", tetapi description kosong, return error
        if (!in_array($note, ['Sakit', 'Ijin']) && empty($description)) {
            return response()->json([
                'pesan' => 'Keterangan belum diisi'
            ], 400);
        }
        // ambil data presensi saat ini
        $presence = Presence::where('teacher_id', $teacher_id)->whereDate('created_at', '=', Carbon::today())->first();

        if (!$presence) { // Jika tidak ada data presensi
            $data = [
                'teacher_id' => $teacher_id,
                'time_in' => ($note == 'Tugas kedinasan') ? $now : '-',
                'time_out' => '-',
                'is_late' => false,
                'note' => $note,
                'description' => $description
            ];

            $presence = Presence::create($data);
            return response()->json([
                'pesan' => "Berhasil menambahkan catatan $note",
                'data' => $presence
            ], 200);
        }
        // Jika catatan adalah "Pulang awal", perbarui time_out
        if ($note == 'Pulang awal') {
            if ($presence->time_out !== '-') {
                return response()->json([
                    'pesan' => 'Presensi pulang sudah dicatat sebelumnya'
                ], 200);
            }

            $presence->time_out = $now;

            // Perbarui catatan tanpa menghapus informasi sebelumnya
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

    // fungsi simpan data presensi (normal) dan cek keterlambatan
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
            'note' => $note,

        ]);
        return response()->json([
            'pesan' => 'Berhasil presensi masuk',
            'data' => $presence
        ], 200);
    }

    public function absenPulang($request)
    {
        $now = Carbon::now(); //tanggal sekarang

        // cek jika ada note sakit, ijin, dan tugas kedinasan
        $presence = Presence::where('teacher_id', $request->teacher_id)->whereDate('created_at', $now)->first();
        if ($presence->time_in == '-' && $presence->time_out == '-') {
            return response()->json(['pesan' => 'tidak bisa mengubah data'], 200);
        } elseif ($presence->note == 'Tugas kedinasan') {
            return response()->json(['pesan' => 'Tidak bisa mengubah data'], 200);
        }

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

    // get waktu presensi
    public function getSettings()
    {
        $list = DB::table('presence_settings')->where(function ($query) {
            $query->where('name', '!=', 'qrcode')
                ->where('name', '!=', 'timeline')
                ->where('name', '!=', 'latitude')
                ->where('name', '!=', 'longitude')
                ->where('name', '!=', 'radius')
                ->where('name', '!=', 'version');
        })->get();
        return response()->json([
            'pesan' => 'Berhasil mendapatkan data Settings',
            'data' => $list
        ], 200);
    }
    // get qr code
    public function getQrCode()
    {
        $qr = DB::table('presence_settings')->where('name', 'qrcode')->first();
        return $qr->value;
    }
    // get latitude, 
    public function getLatitude()
    {
        $latitude = DB::table('presence_settings')->where('name', 'latitude')->first();
        return $latitude->value;
    }
    // get longitude, 
    public function getLongitude()
    {
        $longitude = DB::table('presence_settings')->where('name', 'longitude')->first();
        return $longitude->value;
    }
    // get radius
    public function getRadius()
    {
        $radius = DB::table('presence_settings')->where('name', 'radius')->first();
        return $radius->value;
    }
    // get versi aplikasi
    public function getVersion()
    {
        $radius = DB::table('presence_settings')->where('name', 'version')->first();
        return $radius->value;
    }
}

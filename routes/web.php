<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DocumentController;

use App\Http\Controllers\Teacher\ChildController;
use App\Http\Controllers\Finance\SalaryController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;

use App\Http\Controllers\Finance\PositionController;
use App\Http\Controllers\Teacher\TrainingController;
use App\Http\Controllers\Presence\PresenceController;

use App\Http\Controllers\Teacher\EducationController;
use App\Http\Controllers\Finance\PfunctionalController;

use App\Http\Controllers\Finance\SalaryBasicController;
use App\Http\Controllers\Student\StudentLoginController;
use App\Http\Controllers\Finance\SalarySettingController;
use App\Http\Controllers\Student\StudentParentController;
use App\Http\Controllers\Finance\SalaryAdditionController;
use App\Http\Controllers\Finance\SalaryReductionController;
use App\Http\Controllers\Finance\SalaryFunctionalController;
use App\Http\Controllers\Presence\PresenceSettingController;
use App\Http\Controllers\Presencekar\PresencekaryawanController;
use App\Http\Controllers\Tendik\TendikController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
})->middleware('guest');


//route login, register
Auth::routes(['reset' => false]);

//login-siswa
// route::middleware('guest')->group(function () {
//     Route::get('student-login', [StudentLoginController::class, 'indexLogin']);
//     Route::post('student-login', [StudentLoginController::class, 'authenticate']);
// });

Route::middleware('auth')->group(function () {

    //home
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('change-password', [HomeController::class, 'changePassword']);
    Route::post('change-password', [HomeController::class, 'storeChangePassword']);

    //hanya admin
    Route::middleware('role:admin')->group(function () {
        // untuk menggunakan prefix admin di url tambahkan name diakhiri dengan '.' (titik)
        Route::prefix('admin')->name('admin.')->group(function () {
            //data user
            Route::resource('user', UserController::class);
            Route::resource('school', SchoolController::class);
            Route::resource('teacher', TeacherController::class);
            Route::resource('tendik', TendikController::class);
            // Route::resource('student', StudentController::class);

            // setting
            Route::get('setting', [SettingController::class, 'index'])->name('setting.index');

            // presence
            Route::get('addpresence', [PresenceController::class, 'addpresence'])->name('add.presence');
            Route::post('storepresence', [PresenceController::class, 'storepresence'])->name('store.presence');

            //presence karyawan
            Route::get('addpresencekar', [PresencekaryawanController::class, 'addpresence'])->name('add.presencekar');
            Route::post('storepresencekar', [PresencekaryawanController::class, 'storepresence'])->name('store.presencekar');
        });
    });

    //admin dan operator
    Route::middleware('role:admin|operator')->group(function () {
        Route::prefix('operator')->group(function () {
            //import
            Route::get('bulk', [SalaryController::class, 'bulkcreate'])->name('bulk.create');
            Route::get('listmassal', [SalaryController::class, 'listmassal'])->name('listmassal');
            Route::post('salary-import', [SalaryController::class, 'salaryimport'])->name('salary.import');

            // export
            Route::get('presence-export', [PresenceController::class, 'presenceexport'])->name('presence.export');
            Route::get('salary-export', [SalaryController::class, 'salaryexport'])->name('salary.export');

            //setting 
            Route::resource('presenceset', PresenceSettingController::class);

            //gaji
            Route::resource('salary', SalaryController::class);
            Route::get('list', [SalaryController::class, 'listsalary'])->name('list');
            Route::resource('position', PositionController::class);
            Route::resource('pfunctional', PfunctionalController::class);

            //data gaji
            Route::resource('basic', SalaryBasicController::class);
            Route::resource('functional', SalaryFunctionalController::class);
            Route::resource('addition', SalaryAdditionController::class);
            Route::resource('reduction', SalaryReductionController::class);

            //presence
            Route::resource('presence', PresenceController::class);
            Route::resource('salaryset', SalarySettingController::class);

            //presence karyawan
            Route::resource('presencekaryawan', PresencekaryawanController::class);
            Route::get('presencekar-export', [PresencekaryawanController::class, 'presenceexport'])->name('presencekar.export');
        });
    });

    //guru
    Route::middleware('role:guru')->group(function () {
        Route::prefix('guru')->name('guru.')->group(function () {
            Route::get('teacher-profile', [TeacherController::class, 'profile'])->name('profile');

            //edit guru
            Route::get('teacher-edit/{teacher}', [TeacherController::class, 'editTeacher'])->name('editTeacher');
            Route::put('teacher-store/{teacher}', [TeacherController::class, 'storeTeacher'])->name('storeTeacher');

            // presence
            Route::get('teacher-presence', [PresenceController::class, 'teacherPresence'])->name('teacher.presence');

            //data guru
            Route::resource('education', EducationController::class);
            Route::resource('child', ChildController::class);
            Route::resource('training', TrainingController::class);
            // Route::resource('salary', SalaryController::class)->except('index');
            //teachersalary
            // Route::get('teacher-salary', [SalaryController::class, 'teacherSalary'])->name('teacher.salary');
        });
    });

    //admin dan siswa
    // Route::middleware('role:Admin,Siswa')->group(function () {
    //     Route::prefix('siswa')->group(function () {
    //         Route::resource('student', StudentController::class)->except('index', 'destroy');
    //         Route::get('student-profile', [StudentController::class, 'profile'])->name('student.profile');
    //         Route::resource('student-parent', StudentParentController::class);
    //     });
    // });

    // admin,guru,tendik
    Route::middleware('role:admin|guru|tendik')->group(function () {
        //dokumen
        Route::resource('document', DocumentController::class);
    });
});

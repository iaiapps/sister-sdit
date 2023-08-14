<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PfunctionalController;
use App\Http\Controllers\SalaryBasicController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentParentController;
use App\Http\Controllers\SalaryAdditionController;
use App\Http\Controllers\PresenceSettingController;
use App\Http\Controllers\SalaryReductionController;
use App\Http\Controllers\SalaryFunctionalController;

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
route::middleware('guest')->group(function () {
    Route::get('student-login', [StudentLoginController::class, 'indexLogin']);
    Route::post('student-login', [StudentLoginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {

    //home
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('change-password', [HomeController::class, 'changePassword']);
    Route::post('change-password', [HomeController::class, 'storeChangePassword']);

    //hanya admin
    Route::middleware('role:Admin')->group(function () {
        Route::prefix('admin')->group(function () {
            //data user
            Route::resource('user', UserController::class);
            Route::resource('school', SchoolController::class);
            Route::resource('teacher', TeacherController::class);
            Route::resource('student', StudentController::class);
        });
    });

    //admin dan guru
    Route::middleware('role:Admin,Guru/Tendik')->group(function () {
        Route::prefix('guru')->group(function () {
            Route::get('teacher-profile', [TeacherController::class, 'profile'])->name('profile');
            Route::resource('teacher', TeacherController::class)->except('index', 'destroy');
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
    Route::middleware('role:Admin,Siswa')->group(function () {
        Route::prefix('siswa')->group(function () {
            Route::resource('student', StudentController::class)->except('index', 'destroy');
            Route::get('student-profile', [StudentController::class, 'profile'])->name('student.profile');
            Route::resource('student-parent', StudentParentController::class);
        });
    });

    //admin,guru,siswa
    Route::middleware('role:Admin,Guru/Tendik,Siswa')->group(function () {
        //dokumen
        Route::resource('document', DocumentController::class);
    });

    //admin dan keuangan
    Route::middleware('role:Admin,Keuangan')->group(function () {
        Route::prefix('keuangan')->group(function () {
            //import
            Route::get('bulk', [SalaryController::class, 'bulkcreate'])->name('bulk.create');
            Route::get('listmassal', [SalaryController::class, 'listmassal'])->name('listmassal');
            Route::post('salary-import', [SalaryController::class, 'salaryimport'])->name('salary.import');

            // export
            Route::get('presence-export', [PresenceController::class, 'presenceexport'])->name('presence.export');
            Route::get('salary-export', [SalaryController::class, 'salaryexport'])->name('salary.export');

            //setting 
            Route::resource('setting', SettingController::class);
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
        });
    });
});

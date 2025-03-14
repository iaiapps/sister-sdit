<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\Bpi\BpiController;

use App\Http\Controllers\Bpi\BpiControllerM;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Teacher\ChildController;
use App\Http\Controllers\Finance\SalaryController;

use App\Http\Controllers\Mutabaah\AnswerController;
use App\Http\Controllers\Mutabaah\OptionController;

use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Student\StudentController;

use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Finance\PositionController;
use App\Http\Controllers\Mutabaah\AnswerControllerM;

use App\Http\Controllers\Teacher\TrainingController;
use App\Http\Controllers\Mutabaah\CategoryController;
use App\Http\Controllers\Mutabaah\MutabaahController;
use App\Http\Controllers\Mutabaah\QuestionController;
use App\Http\Controllers\Presence\PresenceController;
use App\Http\Controllers\Teacher\EducationController;
use App\Http\Controllers\Finance\SalaryTypeController;
use App\Http\Controllers\Student\StudentLoginController;
use App\Http\Controllers\Student\StudentParentController;
use App\Http\Controllers\Finance\SalaryPositionController;
use App\Http\Controllers\Setting\PresenceSettingController;
use App\Http\Controllers\Presence\PresencekaryawanController;

use App\Http\Controllers\Replacement\ReplacementController;
use App\Http\Controllers\Replacement\ReplacementControllerM;

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
            Route::put('reset-pass', [UserController::class, 'resetpass'])->name('reset.pass');
            Route::resource('school', SchoolController::class);
            Route::resource('teacher', TeacherController::class);
            Route::get('karyawan', [TeacherController::class, 'karyawan'])->name('karyawan.index');

            // Route::resource('student', StudentController::class);

            // setting
            Route::get('setting', [SettingController::class, 'index'])->name('setting.index');

            //presenceset
            Route::resource('presenceset', PresenceSettingController::class);
        });
    });

    //admin dan operator
    Route::middleware('role:admin|operator')->group(function () {
        Route::prefix('operator')->group(function () {

            // presence
            Route::resource('presence', PresenceController::class);
            Route::get('addpresence', [PresenceController::class, 'addpresence'])->name('add.presence');
            Route::post('storepresence', [PresenceController::class, 'storepresence'])->name('store.presence');
            Route::get('presence-export', [PresenceController::class, 'presenceexport'])->name('presence.export');

            //presence karyawan
            Route::get('addpresencekar', [PresencekaryawanController::class, 'addpresence'])->name('add.presencekar');
            Route::post('storepresencekar', [PresencekaryawanController::class, 'storepresence'])->name('store.presencekar');
            Route::resource('presencekaryawan', PresencekaryawanController::class);
            Route::get('presencekar-export', [PresencekaryawanController::class, 'presenceexport'])->name('presencekar.export');

            //gaji
            // Route::resource('salary', SalaryController::class);
            // Route::get('list', [SalaryController::class, 'listsalary'])->name('list');
            // Route::resource('type', SalaryTypeController::class);
            // Route::resource('position', SalaryPositionController::class);
            // Route::get('bulk', [SalaryController::class, 'bulkcreate'])->name('bulk.create');
            // Route::get('listmassal', [SalaryController::class, 'listmassal'])->name('listmassal');
            // //import
            // Route::post('salary-import', [SalaryController::class, 'salaryimport'])->name('salary.import');
            // // export
            // Route::get('salary-export', [SalaryController::class, 'salaryexport'])->name('salary.export');

            // mutabaah
            Route::resource('mutabaah', MutabaahController::class);
            Route::get('mutabaah-list', [MutabaahController::class, 'mutabaahList'])->name('mutabaah.list');
            Route::get('mutabaah-show', [MutabaahController::class, 'mutabaahShow'])->name('mutabaah.show');
            Route::resource('mutabaah-category', CategoryController::class);
            Route::resource('mutabaah-question', QuestionController::class);
            Route::resource('mutabaah-option', OptionController::class);

            // BPI
            Route::resource('bpi', BpiController::class);

            // guru pengganti
            Route::resource('replacement', ReplacementController::class);
        });
    });

    //guru
    Route::middleware('role:guru|tendik|karyawan')->group(function () {
        Route::prefix('guru')->name('guru.')->group(function () {
            //profile
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

            // teachersalary
            // Route::resource('salary', SalaryController::class)->except('index');
            // Route::get('teacher-salary', [SalaryController::class, 'teacherSalary'])->name('teacher.salary');

            // mutabaah
            Route::resource('answer', AnswerController::class);

            // BPI
            Route::get('bpi', [BpiController::class, 'list'])->name('bpi.list');
            Route::get('bpi-create', [BpiController::class, 'bpiCreate'])->name('bpi.create');
            Route::post('bpi-store', [BpiController::class, 'bpiStore'])->name('bpi.store');
            Route::delete('bpi-destroy/{bpi}', [BpiController::class, 'bpiDestroy'])->name('bpi.destroy');

            // guru pengganti
            Route::get('replacement', [ReplacementController::class, 'list'])->name('replacement.list');
            Route::get('replacement-create', [ReplacementController::class, 'replacementCreate'])->name('replacement.create');
            Route::post('replacement-store', [ReplacementController::class, 'replacementStore'])->name('replacement.store');

            //fungsi logout
            Route::get('basiclogout', function () {
                auth()->logout();
                Session()->flush();
                return redirect()->to('/');
            })->name('basiclogout');
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
    Route::middleware('role:admin|guru|tendik|karyawan')->group(function () {
        //dokumen
        Route::resource('document', DocumentController::class);
    });
});


// akses dari mobile app
Route::middleware('auth.basic')->group(function () {
    Route::resource('mutabaah-mobile', AnswerControllerM::class);
    Route::resource('bpi-mobile', BpiControllerM::class);
    Route::resource('pengganti-mobile', ReplacementControllerM::class);
});
